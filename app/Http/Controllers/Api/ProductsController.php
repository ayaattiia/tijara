<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
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
            'TitleProduct'    => 'required|string|max:250',
            'DescriptionProduct' => 'nullable|string',
            'PriceProduct'    => 'required',
            'ImageProduct'    => 'nullable|array',
            'ImageProduct.*'  => 'string|max:2048', // accepts uploaded files OR plain path/URL strings, checked below
            'VideoProduct'    => 'nullable|array',
            'VideoProduct.*'  => 'string|max:2048',
            'IdFV'            => 'nullable|array',
            'IdFV.*'          => 'integer|exists:FeaturesValues,IdFV',
        ]);

        if ($request->hasFile('ImageProduct')) {
            $request->validate(['ImageProduct.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096']);
        }
        if ($request->hasFile('VideoProduct')) {
            $request->validate(['VideoProduct.*' => 'mimes:mp4,mov,avi,webm|max:' . self::MAX_VIDEO_KB]);
        }

        $data = $request->except(['ImageProduct', 'VideoProduct', 'IdFV']);

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

        if ($request->filled('IdFV')) {
            $item->values()->sync($request->input('IdFV'));
        }

        return response()->json([
            'data'       => $item->load(self::FEATURES_RELATIONS),
            'image_urls' => collect($item->ImageProduct)->map(fn($p) => asset($p)),
            'video_urls' => collect($item->VideoProduct)->map(fn($p) => asset($p)),
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
        ]);

        $item = Products::findOrFail($products);
        $item->update($request->except('IdFV'));

        if ($request->has('IdFV')) {
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
            'image_urls' => collect($item->ImageProduct)->map(fn($p) => asset($p)),
            'video_urls' => collect($item->VideoProduct)->map(fn($p) => asset($p)),
        ]);
    }

    public function destroy($products)
    {
        $item = Products::findOrFail($products);
        $item->delete(); // ProductsFeatureValues rows cleaned up via FK onDelete('cascade')
        return response()->json(null, 204);
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
