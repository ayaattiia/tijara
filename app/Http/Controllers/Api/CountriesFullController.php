<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CountriesFull;
use Illuminate\Http\Request;

class CountriesFullController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(CountriesFull::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = CountriesFull::create($data);
        return response()->json($item, 201);
    }

    public function show($countries_full)
    {
        $item = CountriesFull::findOrFail($countries_full);
        return response()->json($item);
    }

    public function update(Request $request, $countries_full)
    {
        $item = CountriesFull::findOrFail($countries_full);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($countries_full)
    {
        $item = CountriesFull::findOrFail($countries_full);
        $item->delete();
        return response()->json(null, 204);
    }
}
