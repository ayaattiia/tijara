<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Labels;
use Illuminate\Http\Request;

class LabelsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Labels::class,
            ['TitleEn', 'TitleFr', 'TitleAr'],
            ['Color', 'Active'],
            []
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Labels::create($data);
        return response()->json($item, 201);
    }

    public function show($labels)
    {
        $item = Labels::findOrFail($labels);
        return response()->json($item);
    }

    public function update(Request $request, $labels)
    {
        $item = Labels::findOrFail($labels);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($labels)
    {
        $item = Labels::findOrFail($labels);
        $item->delete();
        return response()->json(null, 204);
    }
}
