<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoostAdsPacks;
use Illuminate\Http\Request;

class BoostAdsPacksController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            BoostAdsPacks::class,
            ['Title', 'Links'],
            ['Sliders', 'SideBar', 'Footer', 'RelatedPost', 'FirstLogin', 'Active'],
            ['Price', 'Discount', 'MaxDuration', 'OrdersCount', 'CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = BoostAdsPacks::create($data);
        return response()->json($item, 201);
    }

    public function show($boost_ads_packs)
    {
        $item = BoostAdsPacks::findOrFail($boost_ads_packs);
        return response()->json($item);
    }

    public function update(Request $request, $boost_ads_packs)
    {
        $item = BoostAdsPacks::findOrFail($boost_ads_packs);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($boost_ads_packs)
    {
        $item = BoostAdsPacks::findOrFail($boost_ads_packs);
        $item->delete();
        return response()->json(null, 204);
    }
}
