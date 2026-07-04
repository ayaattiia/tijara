<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CausesReports;
use Illuminate\Http\Request;

class CausesReportsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(CausesReports::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = CausesReports::create($data);
        return response()->json($item, 201);
    }

    public function show($causes_reports)
    {
        $item = CausesReports::findOrFail($causes_reports);
        return response()->json($item);
    }

    public function update(Request $request, $causes_reports)
    {
        $item = CausesReports::findOrFail($causes_reports);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($causes_reports)
    {
        $item = CausesReports::findOrFail($causes_reports);
        $item->delete();
        return response()->json(null, 204);
    }
}
