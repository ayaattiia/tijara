<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListPermissions;
use Illuminate\Http\Request;

class ListPermissionsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            ListPermissions::class,
            ['TitleEn', 'TitleFr', 'TitleAr', 'Description'],
            ['GroupName'],
            []
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = ListPermissions::create($data);
        return response()->json($item, 201);
    }

    public function show($list_permissions)
    {
        $item = ListPermissions::findOrFail($list_permissions);
        return response()->json($item);
    }

    public function update(Request $request, $list_permissions)
    {
        $item = ListPermissions::findOrFail($list_permissions);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($list_permissions)
    {
        $item = ListPermissions::findOrFail($list_permissions);
        $item->delete();
        return response()->json(null, 204);
    }
}
