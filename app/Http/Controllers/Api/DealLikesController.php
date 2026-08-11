<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DealLikes;
use App\Models\Deals;
use Illuminate\Http\Request;

class DealLikesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['IdDeal' => 'required|integer|exists:Deals,IdDeal']);
        $userId = auth('api')->id();

        $exists = DealLikes::where('IdDeal', $request->IdDeal)
            ->where('IdUser', $userId)
            ->first();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Already liked.'], 409);
        }

        $like = DealLikes::create([
            'IdDeal' => $request->IdDeal,
            'IdUser' => $userId,
            'CreatedAt' => now(),
        ]);

        Deals::where('IdDeal', $request->IdDeal)->increment('likes');

        return response()->json(['success' => true, 'data' => $like], 201);
    }

    public function destroy($id)
    {
        $like = DealLikes::findOrFail($id);

        if ($like->IdUser !== auth('api')->id()) {
            abort(403);
        }

        Deals::where('IdDeal', $like->IdDeal)->decrement('likes');
        $like->delete();

        return response()->json(null, 204);
    }
}
