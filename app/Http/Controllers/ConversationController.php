<?php
namespace App\Http\Controllers;

use App\Models\Conversation;
// use App\Models\Users;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    // Liste des conversations de l'utilisateur connecté
    public function index()
    {
        $conversations = auth('api')->user()
            ->conversations()
            ->with(['latestMessage.user', 'users'])
            ->latest('updated_at')
            ->get();

        // return view('conversations.index', compact('conversations'));
        return response()->json($conversations); 
    }

    // Créer (ou récupérer) une conversation 1-to-1 avec un autre utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,IdUser|different:' . auth('api')->id(),
        ]);

        $authId = auth('api')->id();
        $otherId = $request->user_id;

        // Cherche si une conversation entre ces deux users existe déjà
        $conversation = Conversation::whereHas('users', fn ($q) => $q->where('Users.idUser', $authId))
            ->whereHas('users', fn ($q) => $q->where('Users.idUser', $otherId))
            ->first();

        if (! $conversation) {
            $conversation = Conversation::create();
            $conversation->users()->attach([$authId, $otherId]);
        }

        // return redirect()->route('conversations.show', $conversation);
        return response()->json($conversation, 201);
    }

    // Affiche une conversation + son historique de messages
    // public function show(Conversation $conversation)
    // {
    // abort_unless($conversation->users->contains('IdUser', auth('api')->id()), 403);

    //     $conversation->load([
    //         'messages' => fn ($q) => $q->with('user:IdUser,name')->latest()->limit(50),
    //         'users',
    //     ]);

    //     // return view('conversations.show', compact('conversation'));
    //     return response()->json($conversation);
    // }
    public function show(Conversation $conversation)
{
    abort_unless($conversation->users->contains('IdUser', auth('api')->id()), 403);

    $messages = $conversation->messages()
        ->with('user')
        ->latest()
        ->limit(50)
        ->get()
        ->sortBy('created_at')   // 👈 remet dans l'ordre chronologique après la limite
        ->values();

    $conversation->load('users');
    $conversation->setRelation('messages', $messages);

    return response()->json($conversation);
}
}