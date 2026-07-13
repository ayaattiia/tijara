<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = Categories::query();

        // ?idparent=0 => uniquement les categories principales (racines)
        // ?idparent=5 => uniquement les sous-categories de la categorie 5
        if ($request->has('idparent')) {
            $query->where('idparent', $request->query('idparent'));
        }

        // ?idtypecat=2 => filtrer par type de categorie
        if ($request->has('idtypecat')) {
            $query->where('idtypecat', $request->query('idtypecat'));
        }

        // ?active=1 ou ?active=0 => filtrer par statut actif/inactif
        if ($request->has('active')) {
            $query->where('Active', $request->query('active'));
        }

        // ?search=telephone => recherche dans TitleEn, TitleFr, TitleAr et Description
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
}
