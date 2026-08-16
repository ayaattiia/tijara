<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Support\HandlesMediaUpload;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    use HandlesMediaUpload;

    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Brands::class,
            ['Title', 'Description'],
            ['Image', 'Active'],
            []
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->except('Image');

        if ($request->hasFile('Image')) {
            $data['Image'] = $this->storeMediaFile($request->file('Image'), 'brands');
        }

        $item = Brands::create($data);

        return response()->json($item, 201);
    }

    public function show($brands)
    {
        $item = Brands::findOrFail($brands);
        return response()->json($item);
    }

    public function update(Request $request, $brands)
    {
        $item = Brands::findOrFail($brands);
        $data = $request->except('Image');

        if ($request->hasFile('Image')) {
            $this->deleteMediaFile($item->Image, 'brands');
            $data['Image'] = $this->storeMediaFile($request->file('Image'), 'brands');
        }

        $item->update($data);

        return response()->json($item);
    }

    public function destroy($brands)
    {
        $item = Brands::findOrFail($brands);
        $this->deleteMediaFile($item->Image, 'brands');
        $item->delete();
        return response()->json(null, 204);
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
