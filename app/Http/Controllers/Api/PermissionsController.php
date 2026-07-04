<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Permissions::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Permissions::create($data);
        return response()->json($item, 201);
    }

    public function show($permissions)
    {
        $item = Permissions::findOrFail($permissions);
        return response()->json($item);
    }

    public function update(Request $request, $permissions)
    {
        $item = Permissions::findOrFail($permissions);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($permissions)
    {
        $item = Permissions::findOrFail($permissions);
        $item->delete();
        return response()->json(null, 204);
    }
}
