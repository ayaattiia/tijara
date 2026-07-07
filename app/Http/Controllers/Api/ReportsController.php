<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Reports::class,
            ['Subject', 'Description'],
            ['IdUser', 'IdCauseReport', 'State', 'TypeTable', 'IdTable', 'IdProduct'],
            ['Date']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Reports::create($data);
        return response()->json($item, 201);
    }

    public function show($reports)
    {
        $item = Reports::findOrFail($reports);
        return response()->json($item);
    }

    public function update(Request $request, $reports)
    {
        $item = Reports::findOrFail($reports);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($reports)
    {
        $item = Reports::findOrFail($reports);
        $item->delete();
        return response()->json(null, 204);
    }
}
