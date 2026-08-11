<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdLikes;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdLikesController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            AdLikes::class,
            [],
            ['IdAd', 'IdUser'],
            ['CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $request->validate(['IdAd' => 'required|integer|exists:Ads,IdAd']);
        $userId = auth('api')->id();

        $exists = AdLikes::where('IdAd', $request->IdAd)
            ->where('IdUser', $userId)
            ->first();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Already liked.'], 409);
        }

        $item = AdLikes::create([
            'IdAd'      => $request->IdAd,
            'IdUser'    => $userId,
            'CreatedAt' => now(),
        ]);

        Ads::where('IdAd', $request->IdAd)->increment('LikeCount');

        return response()->json(['success' => true, 'data' => $item], 201);
    }

    public function show($ad_likes)
    {
        $item = AdLikes::findOrFail($ad_likes);
        return response()->json($item);
    }

    public function update(Request $request, $ad_likes)
    {
        // Un like n'a pas de sens à "modifier" (IdAd/IdUser sont figés) —
        // on bloque plutôt que de laisser un PUT changer le propriétaire du like.
        return response()->json([
            'success' => false,
            'message' => 'Un like ne peut pas être modifié, seulement créé ou supprimé.'
        ], 405);
    }

    public function destroy($ad_likes)
    {
        $item = AdLikes::findOrFail($ad_likes);

        if ($item->IdUser !== auth('api')->id()) {
            abort(403);
        }

        Ads::where('IdAd', $item->IdAd)->decrement('LikeCount');
        $item->delete();

        return response()->json(null, 204);
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
