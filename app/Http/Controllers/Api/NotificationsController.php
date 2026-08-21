<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    /**
     * GET /api/notifications
     * A user only ever sees their own notifications.
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Notifications::class,
            ['Title', 'Description'],
            ['Type', 'IsRead', 'IdUser'],
            ['Date']
        );
        $query->where('IdUser', auth('api')->id());
        $query->orderByDesc('IdNotification');

        return response()->json($query->paginate($perPage));
    }

    /**
     * GET /api/notifications/unread-count
     * For a bell-icon badge in the frontend.
     */
    public function unreadCount(Request $request)
    {
        $count = Notifications::where('IdUser', auth('api')->id())
            ->where('IsRead', 0)
            ->count();

        return response()->json(['unread' => $count]);
    }

    /**
     * PATCH /api/notifications/{id}/read
     * Mark a single notification as read. Owner only.
     */
    public function markAsRead(Request $request, $id)
    {
        $item = Notifications::findOrFail($id);

        if ($item->IdUser != auth('api')->id()) {
            return response()->json(['message' => 'This notification does not belong to you.'], 403);
        }

        $item->IsRead = 1;
        $item->save();

        return response()->json($item);
    }

    /**
     * PATCH /api/notifications/read-all
     * Mark every notification the current user owns as read.
     */
    public function markAllAsRead(Request $request)
    {
        Notifications::where('IdUser', auth('api')->id())
            ->where('IsRead', 0)
            ->update(['IsRead' => 1]);

        return response()->json(['message' => 'All notifications marked as read.']);
    }

    /**
     * POST /api/notifications  (admin only)
     * Regular users/features should call NotificationService::send() in code
     * instead of hitting this endpoint — this exists for admin/manual
     * broadcast use only, so it's gated by the 'admin' middleware in routes.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Title'       => 'required|string|max:250',
            'Description' => 'nullable|string',
            'Type'        => 'nullable|string|max:250',
            'IdUser'      => 'required|integer|exists:Users,IdUser',
        ]);

        $data['Date'] = now()->toDateString();
        $data['IsRead'] = 0;

        $item = Notifications::create($data);
        return response()->json($item, 201);
    }

    /**
     * GET /api/notifications/{id}
     * Owner or admin only — prevents reading someone else's notification by ID.
     */
    public function show(Request $request, $notifications)
    {
        $item = Notifications::findOrFail($notifications);

        if ($item->IdUser != auth('api')->id() && $request->user()->IdRole != 3) {
            return response()->json(['message' => 'This notification does not belong to you.'], 403);
        }

        return response()->json($item);
    }

    /**
     * DELETE /api/notifications/{id}
     * Owner or admin only.
     */
    public function destroy(Request $request, $notifications)
    {
        $item = Notifications::findOrFail($notifications);

        if ($item->IdUser != auth('api')->id() && $request->user()->IdRole != 3) {
            return response()->json(['message' => 'This notification does not belong to you.'], 403);
        }

        $item->delete();
        return response()->json(null, 204);
    }

    /**
     * Resolve the per_page value from the request, falling back to a default
     * and clamping it between MIN_PER_PAGE and MAX_PER_PAGE.
     */
    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);

        // Guard against negatives or absurdly large values
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
