<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    /**
     * GET /api/categories
     * Flat, paginated list of categories (with optional filters).
     * Each item now includes its direct children (one level deep).
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        // Eager-load direct children so each item in the list carries its own subcategories
        $query = Categories::query()->with('children');

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

    /**
     * GET /api/categories-roots
     * Uniquement les categories principales (idparent = 0), avec leurs enfants directs.
     */
    public function roots()
    {
        return response()->json(
            Categories::roots()->with('children')->get()
        );
    }

    /**
     * GET /api/categories-tree
     * Arbre complet: racines avec enfants imbriqués sur plusieurs niveaux.
     * Nécessite une relation récursive dans le modèle (voir note en bas de fichier).
     */
    public function tree()
    {
        return response()->json(
            Categories::where('idparent', 0)
                ->with('childrenRecursive') // relation récursive, voir modèle
                ->get()
        );
    }

    /**
     * GET /api/categories/{id}/children
     * Les sous-categories directes d'une categorie donnee.
     */
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

    /**
     * GET /api/categories/{id}
     * Retourne la categorie avec son parent et ses enfants directs.
     */
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

    // ⬇️ REPLACE YOUR OLD destroy() WITH THIS ONE ⬇️
    public function destroy($categories)
    {
        $item = Categories::findOrFail($categories);

        DB::transaction(function () use ($item) {
            Categories::where('idparent', $item->id)->update(['idparent' => 0]);
            $item->delete();
        });

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

/*
 * -----------------------------------------------------------------------
 * NOTE — Model relationships required (App\Models\Categories.php)
 * -----------------------------------------------------------------------
 *
 * public function parent()
 * {
 *     return $this->belongsTo(Categories::class, 'idparent');
 * }
 *
 * public function children()
 * {
 *     return $this->hasMany(Categories::class, 'idparent');
 * }
 *
 * // Recursive relation, needed only for the tree() method above (multi-level nesting)
 * public function childrenRecursive()
 * {
 *     return $this->children()->with('childrenRecursive');
 * }
 *
 * public function scopeRoots($query)
 * {
 *     return $query->where('idparent', 0);
 * }
 * -----------------------------------------------------------------------
 */
