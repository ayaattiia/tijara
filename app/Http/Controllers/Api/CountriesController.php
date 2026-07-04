<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Countries::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Countries::create($data);
        return response()->json($item, 201);
    }

    public function show($countries)
    {
        $item = Countries::findOrFail($countries);
        return response()->json($item);
    }

    public function update(Request $request, $countries)
    {
        $item = Countries::findOrFail($countries);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($countries)
    {
        $item = Countries::findOrFail($countries);
        $item->delete();
        return response()->json(null, 204);
    }
}
