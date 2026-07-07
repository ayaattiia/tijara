<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserFollows;
use Illuminate\Http\Request;

class UserFollowsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            UserFollows::class,
            [],
            ['IdUser', 'IdVendor'],
            ['CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = UserFollows::create($data);
        return response()->json($item, 201);
    }

    public function show($user_follows)
    {
        $item = UserFollows::findOrFail($user_follows);
        return response()->json($item);
    }

    public function update(Request $request, $user_follows)
    {
        $item = UserFollows::findOrFail($user_follows);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($user_follows)
    {
        $item = UserFollows::findOrFail($user_follows);
        $item->delete();
        return response()->json(null, 204);
    }
}
