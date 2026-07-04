<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Users::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (isset($data['Password'])) {
            $data['Password'] = Hash::make($data['Password']);
        }
        $item = Users::create($data);
        return response()->json($item, 201);
    }

    public function show($users)
    {
        $item = Users::findOrFail($users);
        return response()->json($item);
    }

    public function update(Request $request, $users)
    {
        $item = Users::findOrFail($users);
        $data = $request->all();
        if (isset($data['Password'])) {
            $data['Password'] = Hash::make($data['Password']);
        } else {
            unset($data['Password']);
        }
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($users)
    {
        $item = Users::findOrFail($users);
        $item->delete();
        return response()->json(null, 204);
    }
}
