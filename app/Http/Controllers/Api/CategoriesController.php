<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Ads;
use App\Support\HandlesMediaUpload;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    use HandlesMediaUpload;

    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);
        $query = Categories::query()->with('children');

        if ($request->has('idparent')) {
            $query->where('idparent', $request->query('idparent'));
        }
        if ($request->has('idtypecat')) {
            $query->where('idtypecat', $request->query('idtypecat'));
        }
        if ($request->has('active')) {
            $query->where('Active', $request->query('active'));
        }
        if ($request->filled('search')) {
            $term = $request->query('search');
            $query->where(function ($q) use ($term) {
                $q->where('TitleEn', 'like', "%{$term}%")
                    ->orWhere('TitleFr', 'like', "%{$term}%")
                    ->orWhere('TitleAr', 'like', "%{$term}%")
                    ->orWhere('Description', 'like', "%{$term}%");
            });
        }

        return response()->json($query->paginate($perPage));
    }

    public function roots()
    {
        return response()->json(Categories::roots()->with('children')->get());
    }

    public function tree()
    {
        return response()->json(
            Categories::where('idparent', 0)->with('childrenRecursive')->get()
        );
    }

    public function children($categories)
    {
        $item = Categories::findOrFail($categories);
        return response()->json($item->children);
    }

    public function store(Request $request)
    {
        $data = $request->except('Image');

        if (!isset($data['idparent'])) {
            $data['idparent'] = 0;
        }

        if ($request->hasFile('Image')) {
            $data['Image'] = $this->storeMediaFile($request->file('Image'), 'categories');
        }

        $item = Categories::create($data);
        return response()->json($item, 201);
    }

    public function show($categories)
    {
        $item = Categories::with(['parent', 'children'])->findOrFail($categories);
        return response()->json($item);
    }

    public function update(Request $request, $categories)
    {
        $item = Categories::findOrFail($categories);
        $data = $request->except('Image');

        if ($request->hasFile('Image')) {
            $this->deleteMediaFile($item->Image, 'categories');
            $data['Image'] = $this->storeMediaFile($request->file('Image'), 'categories');
        }

        $item->update($data);
        return response()->json($item);
    }

    public function destroy($categories)
    {
        $category = Categories::findOrFail($categories);

        DB::transaction(function () use ($category) {
            $childCategory = Categories::where('idparent', $category->IdCateg)->first();

            if ($childCategory) {
                DB::table('products')->where('IdCateg', $category->IdCateg)
                    ->update(['IdCateg' => $childCategory->IdCateg]);
                DB::table('ads')->where('IdCateg', $category->IdCateg)
                    ->update(['IdCateg' => $childCategory->IdCateg]);
                DB::table('featurecategories')->where('IdCategory', $category->IdCateg)
                    ->update(['IdCategory' => $childCategory->IdCateg]);
            }

            Categories::where('idparent', $category->IdCateg)->update(['idparent' => 0]);

            $this->deleteMediaFile($category->Image, 'categories');
            $category->delete();
        });

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ], 200);
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
