<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reclamations;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ReclamationsController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    // Injected, matching your real NotificationService (instance-based, not static)
    protected NotificationService $notifications;

    public function __construct(NotificationService $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * GET /api/my-reclamations
     */
    public function myReclamations(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = Reclamations::where('IdUser', $request->user()->IdUser)
            ->with('cause')
            ->orderByDesc('IdReclamation');

        if ($request->filled('Status')) {
            $query->where('Status', $request->query('Status'));
        }

        return response()->json($query->paginate($perPage));
    }

    /**
     * POST /api/reclamations
     * Body: { "IdCause": 3, "Subject": "...", "Description": "..." }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'IdCause'     => 'nullable|integer|exists:Causes,IdCause',
            'Subject'     => 'required|string|max:250',
            'Description' => 'required|string',
        ]);

        $user = $request->user();
        $now = now();

        $reclamation = Reclamations::create([
            'IdUser'      => $user->IdUser,
            'IdCause'     => $data['IdCause'] ?? null,
            'Subject'     => $data['Subject'],
            'Description' => $data['Description'],
            'Status'      => 'open',
            'CreatedAt'   => $now,
            'UpdatedAt'   => $now,
        ]);

        // NOTE: sendToAdmins (matches your real service), not notifyAdmins
        $this->notifications->sendToAdmins(
            'New complaint received',
            $user->Username . ' filed a ticket: "' . $data['Subject'] . '"',
            'reclamation'
        );

        return response()->json($reclamation->load('cause'), 201);
    }

    /**
     * GET /api/reclamations/{id}
     */
    public function show(Request $request, $id)
    {
        $reclamation = Reclamations::with('cause')->findOrFail($id);

        if ($request->user()->IdRole != 3 && $reclamation->IdUser != $request->user()->IdUser) {
            return response()->json(['message' => 'This ticket does not belong to you.'], 403);
        }

        return response()->json($reclamation);
    }

    /**
     * GET /api/reclamations (admin)
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = Reclamations::with(['user', 'cause'])->orderByDesc('IdReclamation');

        if ($request->filled('Status')) {
            $query->where('Status', $request->query('Status'));
        }

        return response()->json($query->paginate($perPage));
    }

    /**
     * PATCH /api/reclamations/{id}/reply (admin)
     * Body: { "AdminReply": "...", "Status": "resolved" }
     */
    public function reply(Request $request, $id)
    {
        $data = $request->validate([
            'AdminReply' => 'required|string',
            'Status'     => 'nullable|in:open,in_progress,resolved,closed',
        ]);

        $reclamation = Reclamations::findOrFail($id);
        $admin = $request->user();

        $reclamation->AdminReply = $data['AdminReply'];
        $reclamation->Status = $data['Status'] ?? 'resolved';
        $reclamation->RespondedBy = $admin->IdUser;
        $reclamation->RespondedAt = now();
        $reclamation->UpdatedAt = now();
        $reclamation->save();

        $this->notifications->send(
            $reclamation->IdUser,
            'Your ticket was answered',
            'Re: "' . $reclamation->Subject . '" — ' . $data['AdminReply'],
            'reclamation'
        );

        return response()->json($reclamation);
    }

    /**
     * PATCH /api/reclamations/{id}/status (admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'Status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $reclamation = Reclamations::findOrFail($id);
        $reclamation->Status = $data['Status'];
        $reclamation->UpdatedAt = now();
        $reclamation->save();

        return response()->json($reclamation);
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
