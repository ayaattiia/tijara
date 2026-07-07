<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    /**
     * Construit une requete Eloquent filtree/recherchee/triee de facon generique.
     *
     * @param Request $request
     * @param string  $modelClass   Classe du modele (ex: Products::class)
     * @param array   $searchable   Colonnes texte sur lesquelles ?search=... fait un LIKE
     * @param array   $filterable  Colonnes sur lesquelles on autorise un filtre exact
     *                              ex: ?idcateg=3&Active=1
     * @param array   $filterableRanges Colonnes numeriques/dates sur lesquelles on autorise
     *                              des filtres min/max, ex: ?Price_min=10&Price_max=100
     *
     * Parametres de requete generiques supportes automatiquement :
     * - ?search=texte         -> LIKE sur les colonnes $searchable
     * - ?champ=valeur         -> filtre exact si $champ est dans $filterable
     * - ?champ_min / _max     -> filtre range si $champ est dans $filterableRanges
     * - ?sort_by=champ        -> tri (doit etre dans $searchable/$filterable/cle primaire)
     * - ?sort_dir=asc|desc    -> sens du tri (defaut asc)
     */
    protected function buildFilteredQuery(
        Request $request,
        string $modelClass,
        array $searchable = [],
        array $filterable = [],
        array $filterableRanges = []
    ) {
        $query = $modelClass::query();
        $model = new $modelClass();

        // Filtres exacts
        foreach ($filterable as $field) {
            if ($request->has($field) && $request->query($field) !== '') {
                $query->where($field, $request->query($field));
            }
        }

        // Filtres range (min / max)
        foreach ($filterableRanges as $field) {
            if ($request->filled($field . '_min')) {
                $query->where($field, '>=', $request->query($field . '_min'));
            }
            if ($request->filled($field . '_max')) {
                $query->where($field, '<=', $request->query($field . '_max'));
            }
        }

        // Recherche texte (LIKE) sur plusieurs colonnes a la fois
        if ($request->filled('search') && !empty($searchable)) {
            $term = $request->query('search');
            $query->where(function ($q) use ($searchable, $term) {
                foreach ($searchable as $i => $field) {
                    if ($i === 0) {
                        $q->where($field, 'like', "%{$term}%");
                    } else {
                        $q->orWhere($field, 'like', "%{$term}%");
                    }
                }
            });
        }

        // Tri
        if ($request->filled('sort_by')) {
            $sortBy = $request->query('sort_by');
            $sortDir = strtolower($request->query('sort_dir', 'asc')) === 'desc' ? 'desc' : 'asc';
            $allowedSorts = array_merge($searchable, $filterable, $filterableRanges, [$model->getKeyName()]);

            if (in_array($sortBy, $allowedSorts, true)) {
                $query->orderBy($sortBy, $sortDir);
            }
        }

        return $query;
    }
}
