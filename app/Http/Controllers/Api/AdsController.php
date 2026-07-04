<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index(Request $request)
    {
        // ---- Pagination ----
        $perPage = (int) $request->query('per_page', 20);
        $perPage = $perPage > 0 && $perPage <= 100 ? $perPage : 20; // borne de sécurité

        // ---- Base query + jointure User (colonnes sensibles déjà cachées via $hidden) ----
        $query = Ads::with([
            'user:IdUser,Username,FirstName,LastName,Email,ProfilePicture,IsVerified,City',
            'categ',
            'state',
            'country'
        ]);

        // ---- Recherche texte (search) ----
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('TitleAd', 'like', "%{$search}%")
                    ->orWhere('DescriptionAd', 'like', "%{$search}%")
                    ->orWhere('LocationAd', 'like', "%{$search}%")
                    ->orWhere('Brand', 'like', "%{$search}%");
            });
        }

        // ---- Filtres ----
        if ($request->filled('category')) {
            $query->where('IdCateg', $request->query('category'));
        }
        if ($request->filled('typecat')) {
            $query->where('Idtypecat', $request->query('typecat'));
        }
        if ($request->filled('state')) {
            $query->where('IdState', $request->query('state'));
        }
        if ($request->filled('country')) {
            $query->where('IdCountry', $request->query('country'));
        }
        if ($request->filled('user_id')) {
            $query->where('IdUser', $request->query('user_id'));
        }
        if ($request->filled('active')) {
            $query->where('Active', $request->query('active'));
        }
        if ($request->filled('min_price')) {
            $query->where('PriceAd', '>=', $request->query('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('PriceAd', '<=', $request->query('max_price'));
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Ads::create($data);
        return response()->json($item, 201);
    }

    public function show($ads)
    {
        $item = Ads::findOrFail($ads);
        return response()->json($item);
    }

    public function update(Request $request, $ads)
    {
        $item = Ads::findOrFail($ads);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($ads)
    {
        $item = Ads::findOrFail($ads);
        $item->delete();
        return response()->json(null, 204);
    }
}
