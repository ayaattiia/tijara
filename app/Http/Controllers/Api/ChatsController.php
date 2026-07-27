<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chats;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    /**
     * GET /api/chats — uniquement les chats de l'utilisateur connecte
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);
        $me = $request->user()->IdUser;

        $query = $this->buildFilteredQuery(
            $request,
            Chats::class,
            [],
            ['IdUserSender', 'IdUserReciver', 'AdminReview', 'Active'],
            ['CreatedAt']
        )->where(function ($q) use ($me) {
            $q->where('IdUserSender', $me)->orWhere('IdUserReciver', $me);
        });

        return response()->json($query->paginate($perPage));
    }

    /**
     * POST /api/chats/start   { "IdUserReciver": 5 }
     * Retourne le chat existant entre les 2 users, ou en cree un.
     */
    public function start(Request $request)
    {
        $request->validate([
            'IdUserReciver' => 'required|integer|exists:Users,IdUser',
        ]);

        $me = $request->user()->IdUser;
        $other = $request->input('IdUserReciver');

        if ($me == $other) {
            return response()->json(['message' => 'Vous ne pouvez pas discuter avec vous-meme.'], 422);
        }

        $chat = Chats::where(function ($q) use ($me, $other) {
            $q->where('IdUserSender', $me)->where('IdUserReciver', $other);
        })->orWhere(function ($q) use ($me, $other) {
            $q->where('IdUserSender', $other)->where('IdUserReciver', $me);
        })->first();

        if (!$chat) {
            $chat = Chats::create([
                'IdUserSender'  => $me,
                'IdUserReciver' => $other,
                'CreatedAt'     => now(),
                'Active'        => 1,
            ]);
        }

        return response()->json($chat, $chat->wasRecentlyCreated ? 201 : 200);
    }

    public function show(Request $request, $chats)
    {
        $item = Chats::findOrFail($chats);
        $this->authorizeChatAccess($request, $item);

        return response()->json($item);
    }

    public function update(Request $request, $chats)
    {
        $item = Chats::findOrFail($chats);
        $this->authorizeChatAccess($request, $item);

        // seuls Active/AdminReview ont du sens a modifier ici, pas les IdUser*
        $item->update($request->only(['Active', 'AdminReview']));

        return response()->json($item);
    }

    public function destroy(Request $request, $chats)
    {
        $item = Chats::findOrFail($chats);
        $this->authorizeChatAccess($request, $item);

        $item->delete();
        return response()->json(null, 204);
    }

    private function authorizeChatAccess(Request $request, Chats $chat): void
    {
        $me = $request->user()->IdUser;

        if ((int) $chat->IdUserSender !== (int) $me && (int) $chat->IdUserReciver !== (int) $me) {
            abort(403, 'Acces non autorise a cette conversation.');
        }
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}