<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Features;
use App\Models\FeaturesValues;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    // Nested eager-load: for each product, load its attached FeaturesValues,
    // and for each value load the parent Feature it belongs to.
    private const FEATURES_RELATIONS = ['values.feature'];

    // Written straight into /public, no storage symlink involved
    private const IMAGES_FOLDER = 'assets/products/images';
    private const VIDEOS_FOLDER = 'assets/products/videos';

    // Max video upload size in kilobytes (100 MB). Must also be raised in
    // php.ini (upload_max_filesize, post_max_size).
    private const MAX_VIDEO_KB = 102400;

    /**
     * GET /api/products?per_page=5&page=1&search=&IdFV=
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Products::class,
            ['TitleProduct', 'DescriptionProduct', 'CodeProduct', 'ReferenceProduct', 'CodeBarProduct'], // search=
            ['IdCateorie', 'IdUser', 'IdPrize', 'Active'], // exact filters
            ['PriceProduct', 'QuantityProduct'] // range filters -> PriceProduct_min= / PriceProduct_max=
        )->with($this->featuresRelations($request));

        // Advanced filter: only products that have a given FeaturesValue attached (?IdFV=..)
        if ($request->filled('IdFV')) {
            $query->select('Products.*')
                ->distinct()
                ->join('ProductsFeatureValues', 'ProductsFeatureValues.IdProduct', '=', 'Products.IdProduct')
                ->where('ProductsFeatureValues.IdFV', $request->query('IdFV'));
        }

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $request->validate([
            'TitleProduct'        => 'required|string|max:250',
            'DescriptionProduct'  => 'nullable|string',
            'PriceProduct'        => 'required',
            'ImageProduct'        => 'nullable|array',
            'ImageProduct.*'      => 'string|max:2048', // accepts uploaded files OR plain path/URL strings, checked below
            'VideoProduct'        => 'nullable|array',
            'VideoProduct.*'      => 'string|max:2048',

            // Legacy: still accepted if you already know the IdFV(s)
            'IdFV'                => 'nullable|array',
            'IdFV.*'              => 'integer|exists:FeaturesValues,IdFV',

            // New: pass the feature name + value directly, no IdFV needed.
            // If the Feature or the FeaturesValue doesn't exist yet, it is created.
            'Features'                        => 'nullable|array',
            'Features.*.TitleFeature'         => 'required_with:Features|string|max:250',
            'Features.*.ValueFeature'         => 'required_with:Features|string|max:250',
            'Features.*.UnitFeature'          => 'nullable|string|max:100',
            'Features.*.DescriptionFeature'   => 'nullable|string',
        ]);

        if ($request->hasFile('ImageProduct')) {
            $request->validate(['ImageProduct.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096']);
        }
        if ($request->hasFile('VideoProduct')) {
            $request->validate(['VideoProduct.*' => 'mimes:mp4,mov,avi,webm|max:' . self::MAX_VIDEO_KB]);
        }

        $data = $request->except(['ImageProduct', 'VideoProduct', 'IdFV', 'Features']);

        if ($request->hasFile('ImageProduct')) {
            $data['ImageProduct'] = $this->storeMediaFiles($request->file('ImageProduct'), self::IMAGES_FOLDER);
        } elseif ($request->filled('ImageProduct')) {
            $data['ImageProduct'] = $request->input('ImageProduct');
        }

        if ($request->hasFile('VideoProduct')) {
            $data['VideoProduct'] = $this->storeMediaFiles($request->file('VideoProduct'), self::VIDEOS_FOLDER);
        } elseif ($request->filled('VideoProduct')) {
            $data['VideoProduct'] = $request->input('VideoProduct');
        }

        $item = Products::create($data);

        // Resolve/attach feature values: prefer the new name-based "Features"
        // input, fall back to raw "IdFV" if that's what was sent instead.
        $idFVs = [];
        if ($request->filled('Features')) {
            $idFVs = $this->resolveFeatureValueIds($request->input('Features'));
        } elseif ($request->filled('IdFV')) {
            $idFVs = $request->input('IdFV');
        }

        if (!empty($idFVs)) {
            $item->values()->sync($idFVs);
        }

        return response()->json([
            'data'       => $item->load(self::FEATURES_RELATIONS),
            'image_urls' => $this->mediaUrls($item->ImageProduct, self::IMAGES_FOLDER),
            'video_urls' => $this->mediaUrls($item->VideoProduct, self::VIDEOS_FOLDER),
        ], 201);
    }

    public function show($products)
    {
        $item = Products::with(self::FEATURES_RELATIONS)->findOrFail($products);
        return response()->json($item);
    }

    /**
     * Text/relation fields only. No file inputs — PHP does not populate
     * $_FILES on PUT requests, so uploads must go through addMedia() (POST).
     */
    public function update(Request $request, $products)
    {
        $request->validate([
            'IdFV'   => 'nullable|array',
            'IdFV.*' => 'integer|exists:FeaturesValues,IdFV',

            'Features'                      => 'nullable|array',
            'Features.*.TitleFeature'       => 'required_with:Features|string|max:250',
            'Features.*.ValueFeature'       => 'required_with:Features|string|max:250',
            'Features.*.UnitFeature'        => 'nullable|string|max:100',
            'Features.*.DescriptionFeature' => 'nullable|string',
        ]);

        $item = Products::findOrFail($products);
        $item->update($request->except(['IdFV', 'Features']));

        if ($request->filled('Features')) {
            $item->values()->sync($this->resolveFeatureValueIds($request->input('Features')));
        } elseif ($request->has('IdFV')) {
            $item->values()->sync($request->input('IdFV', []));
        }

        return response()->json($item->load(self::FEATURES_RELATIONS));
    }

    /**
     * POST /api/products/{products}/media
     * Adds photos/videos to an EXISTING product — never creates a new
     * product, just appends the newly uploaded files onto
     * ImageProduct/VideoProduct. Uses POST because PHP only parses
     * multipart file uploads on POST requests.
     */
    public function addMedia(Request $request, $products)
    {
        $request->validate([
            'ImageProduct'   => 'nullable|array',
            'ImageProduct.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'VideoProduct'   => 'nullable|array',
            'VideoProduct.*' => 'mimes:mp4,mov,avi,webm|max:' . self::MAX_VIDEO_KB,
        ]);

        $item = Products::findOrFail($products);
        $data = [];

        if ($request->hasFile('ImageProduct')) {
            $data['ImageProduct'] = array_merge(
                $this->normalizeMediaArray($item->getRawOriginal('ImageProduct')),
                $this->storeMediaFiles($request->file('ImageProduct'), self::IMAGES_FOLDER)
            );
        }

        if ($request->hasFile('VideoProduct')) {
            $data['VideoProduct'] = array_merge(
                $this->normalizeMediaArray($item->getRawOriginal('VideoProduct')),
                $this->storeMediaFiles($request->file('VideoProduct'), self::VIDEOS_FOLDER)
            );
        }

        if (empty($data)) {
            return response()->json(['message' => 'No ImageProduct or VideoProduct files were sent.'], 422);
        }

        $item->update($data);

        return response()->json([
            'data'       => $item->load(self::FEATURES_RELATIONS),
            'image_urls' => $this->mediaUrls($item->ImageProduct, self::IMAGES_FOLDER),
            'video_urls' => $this->mediaUrls($item->VideoProduct, self::VIDEOS_FOLDER),
        ]);
    }

    public function destroy($products)
    {
        $item = Products::findOrFail($products);
        $item->delete(); // ProductsFeatureValues rows cleaned up via FK onDelete('cascade')
        return response()->json(null, 204);
    }

    /**
     * PUT /api/products/{products}/assign-prize
     * findOrFail() -> 404 automatically if $products doesn't exist.
     * 'exists:Prizes,IdPrize' -> 422 automatically if IdPrize doesn't exist.
     * If the same IdPrize is already attached, returns 409 instead of no-op.
     */
    public function assignPrize(Request $request, $products)
    {
        $request->validate([
            'IdPrize' => 'required|integer|exists:Prizes,IdPrize',
        ]);

        $item = Products::findOrFail($products);

        $currentIdPrize = $item->IdPrize;
        $newIdPrize     = (int) $request->input('IdPrize');

        // Same prize already assigned -> reject as duplicate
        if ((int) $currentIdPrize === $newIdPrize) {
            return response()->json([
                'message' => 'Prize is already assigned to this product.',
            ], 409);
        }

        $item->IdPrize = $newIdPrize;
        $item->save();

        // Had a different prize before -> this call replaced it
        if (! is_null($currentIdPrize)) {
            return response()->json([
                'message' => 'Prize updated successfully.',
            ]);
        }

        // Had no prize before -> this is a fresh assignment
        return response()->json([
            'message' => 'Prize assigned successfully.',
        ]);
    }

    /**
     * DELETE /api/products/{products}/remove-prize
     */
    public function removePrize($products)
    {
        $item = Products::findOrFail($products);
        $item->IdPrize = null;
        $item->save();

        return response()->json([
            'message' => 'Prize removed successfully.',
        ]);
    }

    /**
     * Which relations to eager-load for the "values" list.
     * If ?IdFV= is set, only that matching value is loaded per product
     * instead of the product's full feature/value list.
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
     * Turn a list of ["TitleFeature" => .., "ValueFeature" => ..] into an
     * array of IdFV, creating the Feature and/or the FeaturesValue rows if
     * they don't already exist. Matching is case-sensitive on the exact
     * strings you send — send the same TitleFeature you used before if you
     * want to reuse an existing feature instead of creating a duplicate.
     */
    private function resolveFeatureValueIds(array $features): array
    {
        $ids = [];

        foreach ($features as $feature) {
            $titleFeature = trim($feature['TitleFeature'] ?? '');
            $valueFeature = trim($feature['ValueFeature'] ?? '');

            if ($titleFeature === '' || $valueFeature === '') {
                continue;
            }

            $featureModel = Features::firstOrCreate(
                ['TitleFeature' => $titleFeature],
                [
                    'DescriptionFeature' => $feature['DescriptionFeature'] ?? null,
                    'UnitFeature'        => $feature['UnitFeature'] ?? null,
                    'Active'             => 1,
                ]
            );

            $featureValue = FeaturesValues::firstOrCreate(
                [
                    'IdFeature'    => $featureModel->IdFeature,
                    'ValueFeature' => $valueFeature,
                ],
                ['Active' => 1]
            );

            $ids[] = $featureValue->IdFV;
        }

        return array_values(array_unique($ids));
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);

        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }

    /**
     * Normalize an existing ImageProduct/VideoProduct value into a plain
     * array, regardless of whether it's already an array, a JSON string,
     * a legacy plain filename string, or null.
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

            return [$value];
        }

        return [];
    }

    /**
     * Move uploaded files straight into public/{$folder} (no storage
     * symlink needed) and return the array of FILENAMES ONLY to save in
     * the DB — the file's own original name (e.g. "samsoung.jpg"), not a
     * generated one.
     *
     * @param  \Illuminate\Http\UploadedFile[]  $files
     */
    private function storeMediaFiles(array $files, string $folder): array
    {
        $destination = public_path($folder);

        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $filenames = [];
        foreach ($files as $file) {
            $filename = $this->uniqueFilename($destination, $file->getClientOriginalName());
            $file->move($destination, $filename);
            $filenames[] = $filename;
        }

        return $filenames;
    }

    /**
     * Return the original filename as-is if nothing on disk uses it yet.
     * If a file with that exact name already exists in the folder, append
     * a short suffix ("samsoung_1.jpg", "samsoung_2.jpg", ...) so the
     * earlier upload is never silently overwritten.
     */
    private function uniqueFilename(string $destination, string $originalName): string
    {
        $filename  = basename($originalName);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $name      = pathinfo($filename, PATHINFO_FILENAME);

        $candidate = $filename;
        $i = 1;
        while (file_exists($destination . DIRECTORY_SEPARATOR . $candidate)) {
            $candidate = $extension !== ''
                ? "{$name}_{$i}.{$extension}"
                : "{$name}_{$i}";
            $i++;
        }

        return $candidate;
    }

    /**
     * Build full public URLs from the filenames stored in the DB, by
     * prefixing them with the folder they physically live in.
     */
    private function mediaUrls(?array $filenames, string $folder)
    {
        return collect($filenames ?? [])->map(fn($filename) => asset($folder . '/' . $filename));
    }



    public function removePhoto(Request $request, $products)
{
    $request->validate([
        'index' => 'required|integer|min:0',
    ]);

    $item = Products::findOrFail($products);

    $photos = $this->normalizeMediaArray($item->getRawOriginal('ImageProduct'));

    $index = (int) $request->query('index');

    if (!isset($photos[$index])) {
        return response()->json([
            'message' => 'Photo not found.'
        ], 404);
    }

    $filename = $photos[$index];

    $file = public_path(self::IMAGES_FOLDER . '/' . $filename);

    if (file_exists($file)) {
        unlink($file);
    }

    unset($photos[$index]);

    $photos = array_values($photos);

    $item->update([
        'ImageProduct' => $photos
    ]);

    return response()->json([
        'message' => 'Photo removed successfully.',
        'data' => $item->fresh(),
        'image_urls' => $this->mediaUrls(
            $item->fresh()->ImageProduct,
            self::IMAGES_FOLDER
        ),
    ]);
}


public function removeVideo(Request $request, $products)
{
    $request->validate([
        'index' => 'required|integer|min:0',
    ]);

    $item = Products::findOrFail($products);

    $videos = $this->normalizeMediaArray($item->getRawOriginal('VideoProduct'));

    $index = (int) $request->query('index');

    if (!isset($videos[$index])) {
        return response()->json([
            'message' => 'Video not found.'
        ], 404);
    }

    $filename = $videos[$index];

    $file = public_path(self::VIDEOS_FOLDER . '/' . $filename);

    if (file_exists($file)) {
        unlink($file);
    }

    unset($videos[$index]);

    $videos = array_values($videos);

    $item->update([
        'VideoProduct' => $videos
    ]);

    return response()->json([
        'message' => 'Video removed successfully.',
        'data' => $item->fresh(),
        'video_urls' => $this->mediaUrls(
            $item->fresh()->VideoProduct,
            self::VIDEOS_FOLDER
        ),
    ]);
}


}
