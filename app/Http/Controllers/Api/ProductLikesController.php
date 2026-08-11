<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductLikes;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductLikesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['IdProduct' => 'required|integer|exists:Products,IdProduct']);
        $userId = auth('api')->id();

        $exists = ProductLikes::where('IdProduct', $request->IdProduct)
            ->where('IdUser', $userId)
            ->first();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Already liked.'], 409);
        }

        $like = ProductLikes::create([
            'IdProduct' => $request->IdProduct,
            'IdUser'    => $userId,
            'CreatedAt' => now(),
        ]);

        Products::where('IdProduct', $request->IdProduct)->increment('LikeCount');

        return response()->json(['success' => true, 'data' => $like], 201);
    }

    public function destroy($id)
    {
        $like = ProductLikes::findOrFail($id);

        if ($like->IdUser !== auth('api')->id()) {
            abort(403);
        }

        Products::where('IdProduct', $like->IdProduct)->decrement('LikeCount');
        $like->delete();

        return response()->json(null, 204);
    }
}
