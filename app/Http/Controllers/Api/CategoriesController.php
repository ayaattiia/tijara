<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);

        // ?idparent=0 => uniquement les categories principales (racines)
        // ?idparent=5 => uniquement les sous-categories de la categorie 5
        if ($request->has('idparent')) {
            return response()->json(
                Categories::where('idparent', $request->query('idparent'))->paginate($perPage)
            );
        }

        return response()->json(Categories::paginate($perPage));
    }

    // GET /api/categories-roots : uniquement les categories principales (idparent = 0)
    public function roots()
    {
        return response()->json(Categories::roots()->get());
    }

    // GET /api/categories/{id}/children : les sous-categories d'une categorie donnee
    public function children($categories)
    {
        $item = Categories::findOrFail($categories);
        return response()->json($item->children);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Si idparent n'est pas fourni, c'est une categorie principale (racine)
        if (!isset($data['idparent'])) {
            $data['idparent'] = 0;
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
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($categories)
    {
        $item = Categories::findOrFail($categories);
        $item->delete();
        return response()->json(null, 204);
    }
}