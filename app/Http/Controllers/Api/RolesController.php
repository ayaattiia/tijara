<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Roles::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Roles::create($data);
        return response()->json($item, 201);
    }

    public function show($roles)
    {
        $item = Roles::findOrFail($roles);
        return response()->json($item);
    }

    public function update(Request $request, $roles)
    {
        $item = Roles::findOrFail($roles);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($roles)
    {
        $item = Roles::findOrFail($roles);
        $item->delete();
        return response()->json(null, 204);
    }
}
