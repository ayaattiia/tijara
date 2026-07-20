<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    // Nested eager-load: for each ad, load its attached FeaturesValues,
    // and for each value load the parent Feature it belongs to.
    private const FEATURES_RELATIONS = ['values.feature'];

    // Written straight into /public, no storage symlink involved
    private const IMAGES_FOLDER = 'assets/ads/images';
    private const VIDEOS_FOLDER = 'assets/ads/videos';

    // Max video upload size in kilobytes (100 MB). Must also be raised in
    // php.ini (upload_max_filesize, post_max_size) or PHP rejects the
    // file before this rule ever runs — see notes below.
    private const MAX_VIDEO_KB = 102400;

    /**
     * GET /api/ads?per_page=5&page=3&search=&PriceAd_max=&PriceAd_min=&IdCateg=&IdFV=
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Ads::class,
            ['TitleAd', 'DescriptionAd', 'DetailsAd', 'LocationAd', 'Telephone', 'Email'], // search=
            ['IdCateg', 'IdUser', 'Color', 'Brand', 'Ownerads', 'Active', 'Type'], // exact filters, includes IdCateg=
            ['PriceAd', 'DatePublication', 'DateEnd', 'StartDate'] // range filters -> PriceAd_min= / PriceAd_max=
        )->with($this->featuresRelations($request));

        // Advanced filter: only ads that have a given FeaturesValue attached (?IdFV=..)
        if ($request->filled('IdFV')) {
            $query->select('Ads.*')
                ->distinct()
                ->join('AdsFeatureValues', 'AdsFeatureValues.IdAd', '=', 'Ads.IdAd')
                ->where('AdsFeatureValues.IdFV', $request->query('IdFV'));
        }

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $request->validate([
            'TitleAd'       => 'required|string|max:250',
            'DescriptionAd' => 'nullable|string',
            'PriceAd'       => 'required',
            'ImageAd'       => 'nullable|array',
            'ImageAd.*'     => 'string|max:2048', // accepts either uploaded files OR plain path/URL strings, checked below
            'VideoAd'       => 'nullable|array',
            'VideoAd.*'     => 'string|max:2048',
            'IdFV'          => 'nullable|array',
            'IdFV.*'        => 'integer|exists:FeaturesValues,IdFV',
        ]);

        // If real files were uploaded, validate them as files specifically
        if ($request->hasFile('ImageAd')) {
            $request->validate(['ImageAd.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096']);
        }
        if ($request->hasFile('VideoAd')) {
            $request->validate(['VideoAd.*' => 'mimes:mp4,mov,avi,webm|max:' . self::MAX_VIDEO_KB]);
        }

        $data = $request->except(['ImageAd', 'VideoAd', 'IdFV']);

        if ($request->hasFile('ImageAd')) {
            // Real uploaded files: move them and store the resulting paths
            $data['ImageAd'] = $this->storeMediaFiles($request->file('ImageAd'), self::IMAGES_FOLDER);
        } elseif ($request->filled('ImageAd')) {
            // JSON-only test/seed data: store the given strings as-is
            $data['ImageAd'] = $request->input('ImageAd');
        }

        if ($request->hasFile('VideoAd')) {
            $data['VideoAd'] = $this->storeMediaFiles($request->file('VideoAd'), self::VIDEOS_FOLDER);
        } elseif ($request->filled('VideoAd')) {
            $data['VideoAd'] = $request->input('VideoAd');
        }

        $item = Ads::create($data);

        if ($request->filled('IdFV')) {
            $item->values()->sync($request->input('IdFV'));
        }

        return response()->json([
            'data'       => $item->load(self::FEATURES_RELATIONS),
            'image_urls' => collect($item->ImageAd)->map(fn($p) => asset($p)),
            'video_urls' => collect($item->VideoAd)->map(fn($p) => asset($p)),
        ], 201);
    }

    public function show($ads)
    {
        $item = Ads::with(self::FEATURES_RELATIONS)->findOrFail($ads);
        return response()->json($item);
    }

    /**
     * Text/relation fields only. No file inputs here — PHP does not
     * populate $_FILES on PUT requests, so uploads must go through
     * addMedia() (POST) instead.
     */
    public function update(Request $request, $ads)
    {
        $request->validate([
            'IdFV'   => 'nullable|array',
            'IdFV.*' => 'integer|exists:FeaturesValues,IdFV',
        ]);

        $item = Ads::findOrFail($ads);
        $item->update($request->except('IdFV'));

        if ($request->has('IdFV')) {
            $item->values()->sync($request->input('IdFV', []));
        }

        return response()->json($item->load(self::FEATURES_RELATIONS));
    }

    /**
     * POST /api/ads/{ads}/photos
     * Adds photos/videos to an EXISTING ad — never creates a new ad,
     * just appends the newly uploaded files onto ImageAd/VideoAd.
     * Uses POST (not PUT) because PHP only parses multipart file
     * uploads on POST requests.
     */
    public function addMedia(Request $request, $ads)
    {
        $request->validate([
            'ImageAd'   => 'nullable|array',
            'ImageAd.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'VideoAd'   => 'nullable|array',
            'VideoAd.*' => 'mimes:mp4,mov,avi,webm|max:' . self::MAX_VIDEO_KB,
        ]);

        $item = Ads::findOrFail($ads);
        $data = [];

        if ($request->hasFile('ImageAd')) {
            $data['ImageAd'] = array_merge(
                $this->normalizeMediaArray($item->getRawOriginal('ImageAd')),
                $this->storeMediaFiles($request->file('ImageAd'), self::IMAGES_FOLDER)
            );
        }

        if ($request->hasFile('VideoAd')) {
            $data['VideoAd'] = array_merge(
                $this->normalizeMediaArray($item->getRawOriginal('VideoAd')),
                $this->storeMediaFiles($request->file('VideoAd'), self::VIDEOS_FOLDER)
            );
        }

        if (empty($data)) {
            return response()->json(['message' => 'No ImageAd or VideoAd files were sent.'], 422);
        }

        $item->update($data);

        return response()->json([
            'data'       => $item->load(self::FEATURES_RELATIONS),
            'image_urls' => collect($item->ImageAd)->map(fn($p) => asset($p)),
            'video_urls' => collect($item->VideoAd)->map(fn($p) => asset($p)),
        ]);
    }

    public function destroy($ads)
    {
        $item = Ads::findOrFail($ads);
        $item->delete(); // AdsFeatureValues rows are cleaned up via FK onDelete('cascade')
        return response()->json(null, 204);
    }

    /**
     * Which relations to eager-load for the "values" list.
     * If ?IdFV= is set, only that matching value is loaded per ad
     * instead of the ad's full feature/value list.
     */
    private function featuresRelations(Request $request): array
    {
        if ($request->filled('IdFV')) {
            $idFV = $request->query('IdFV');

            return [
                'values' => fn($q) => $q->where('FeaturesValues.IdFV', $idFV),
                'values.feature',
            ];
        }

        return self::FEATURES_RELATIONS;
    }

    /**
     * Resolve the per_page value from the request, falling back to a default
     * and clamping it between MIN_PER_PAGE and MAX_PER_PAGE.
     */
    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);

        // Guard against negatives or absurdly large values
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }

    /**
     * Normalize an existing ImageAd/VideoAd value into a plain array,
     * regardless of whether it's already an array, a JSON string, a
     * legacy plain filename string (pre-conversion data), or null.
     */
    private function normalizeMediaArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if ($value === null || $value === '') {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }

            // Legacy single filename stored as a plain string, e.g. "watch.jpg"
            return [$value];
        }

        return [];
    }

    /**
     * Move uploaded files straight into public/{$folder} (no storage
     * symlink needed) and return the array of relative paths to save.
     *
     * @param  \Illuminate\Http\UploadedFile[]  $files
     */
    private function storeMediaFiles(array $files, string $folder): array
    {
        $destination = public_path($folder);

        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $paths = [];
        foreach ($files as $file) {
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);
            $paths[] = $folder . '/' . $filename;
        }

        return $paths;
    }
}
