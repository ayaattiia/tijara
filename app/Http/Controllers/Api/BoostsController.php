<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Boosts;
use Illuminate\Http\Request;

class BoostsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Boosts::class,
            ['TitleBoost', 'HasLinks'],
            ['InSliders', 'InSideBar', 'InFooter', 'InRelatedPost', 'InFirstLogin', 'Orders'],
            ['Price', 'Discount', 'MaxDurationPerDay']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Boosts::create($data);
        return response()->json($item, 201);
    }

    public function show($boosts)
    {
        $item = Boosts::findOrFail($boosts);
        return response()->json($item);
    }

    public function update(Request $request, $boosts)
    {
        $item = Boosts::findOrFail($boosts);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($boosts)
    {
        $item = Boosts::findOrFail($boosts);
        $item->delete();
        return response()->json(null, 204);
    }
}
