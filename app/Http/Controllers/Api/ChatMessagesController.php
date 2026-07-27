<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatMessages;
use App\Models\Chats;
use Illuminate\Http\Request;

use App\Models\ChatMessageAttachments;
use Illuminate\Support\Facades\Storage;

class ChatMessagesController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    /**
     * GET /api/chats/{idChat}/messages
     */
    public function index(Request $request, $idChat)
    {
        $chat = Chats::findOrFail($idChat);
        $this->authorizeChatAccess($request, $chat);

        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            ChatMessages::class,
            ['Message'],
            ['IdUserSender', 'Active'],
            ['CreateDate']
        )
            ->with('attachments')
            ->where('IdChat', $idChat)
            ->orderBy('CreateDate');

        return response()->json($query->paginate($perPage));
    }

    /**
     * POST /api/chats/{idChat}/messages
     */
  public function store(Request $request, $idChat)
{
    $chat = Chats::findOrFail($idChat);
    $this->authorizeChatAccess($request, $chat);

    $request->validate([
        'Message' => 'nullable|string|max:2000',
        'Files' => 'nullable|array',
        'Files.*' => 'file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,mp4,mp3,zip'
        // 'Files.*' => 'file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,mp4,mp3,zip|max:10240'
    ]);

    // Au moins un message ou un fichier
    if (!$request->filled('Message') && !$request->hasFile('Files')) {
        return response()->json([
            'message' => 'Le message ou au moins un fichier est obligatoire.'
        ], 422);
    }

    // Création du message
    $message = ChatMessages::create([
        'IdChat'       => $idChat,
        'Message'      => $request->input('Message'),
        'CreateDate'   => now(),
        'IdUserSender' => $request->user()->IdUser,
        'Active'       => 1,
    ]);

    // Sauvegarde des fichiers
    if ($request->hasFile('Files')) {

    $destinationPath = public_path('assets/chats');

    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }

    foreach ($request->file('Files') as $file) {

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $fileName);
        
        // dd([
        //     'message' => $message,
        //     'hasFile' => $request->hasFile('Files'),
        //     'files' => $request->file('Files'),
        // ]);
        ChatMessageAttachments::create([
            'IdChatMessage' => $message->IdChatMessage,
            'OriginalName'  => $file->getClientOriginalName(),
            'FileName'      => $fileName,
            'FilePath'      => 'assets/chats/' . $fileName,
            'MimeType'      => $file->getMimeType(),
            'FileSize'      => $file->getSize(),
            'CreatedAt'     => now(),
            'Active'        => 1,
        ]);
    }
}

    // Charger les pièces jointes
    $message->load('attachments');

    broadcast(new MessageSent($message))->toOthers();

    return response()->json($message, 201);
}

    /**
     * GET /api/chat-messages/{id}
     */
    public function show(Request $request, $chat_messages)
    {
        $item = ChatMessages::with('attachments')->findOrFail($chat_messages);

        $chat = Chats::findOrFail($item->IdChat);
        $this->authorizeChatAccess($request, $chat);

        return response()->json($item);
    }

    /**
     * DELETE /api/chat-messages/{id}
     */
    public function destroy(Request $request, $chat_messages)
    {
        $item = ChatMessages::findOrFail($chat_messages);

        $chat = Chats::findOrFail($item->IdChat);
        $this->authorizeChatAccess($request, $chat);

        $item->delete();

        return response()->json(null, 204);
    }

    private function authorizeChatAccess(Request $request, Chats $chat): void
    {
        $me = $request->user()->IdUser;

        if (
            (int) $chat->IdUserSender !== (int) $me &&
            (int) $chat->IdUserReciver !== (int) $me
        ) {
            abort(403, 'Acces non autorise a cette conversation.');
        }
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);

        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}