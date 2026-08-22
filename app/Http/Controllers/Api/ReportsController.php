<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    // State: 0 = pending, 1 = resolved, 2 = rejected
    private const STATE_PENDING  = 0;
    private const STATE_RESOLVED = 1;
    private const STATE_REJECTED = 2;

    public function __construct(private NotificationService $notifications) {}

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Reports::class,
            ['Subject', 'Description'],
            ['IdUser', 'IdCauseReport', 'State', 'TypeTable', 'IdTable', 'IdProduct'],
            ['Date']
        );

        return response()->json($query->paginate($perPage));
    }

    /**
     * POST /api/reports
     * IdUser is always the authenticated reporter, never trusted from
     * the request body. Notifies every admin the moment it's filed.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Subject'       => 'required|string|max:250',
            'Description'   => 'nullable|string',
            'IdCauseReport' => 'nullable|integer',
            'TypeTable'     => 'nullable|string|max:250',
            'IdTable'       => 'nullable|integer',
            'IdProduct'     => 'nullable|string|max:10',
        ]);

        $data['IdUser'] = $request->user()->IdUser;
        $data['Date']   = now()->toDateString();
        $data['State']  = self::STATE_PENDING;

        $item = Reports::create($data);

        $this->notifications->sendToAdmins(
            'Nouvelle réclamation',
            "\"{$item->Subject}\" signalé par {$request->user()->Username}.",
            NotificationService::TYPE_REPORT_RECEIVED
        );

        return response()->json($item, 201);
    }

    public function show($reports)
    {
        $item = Reports::findOrFail($reports);
        return response()->json($item);
    }

    public function update(Request $request, $reports)
    {
        $item = Reports::findOrFail($reports);
        $item->update($request->except(['IdUser'])); // l'auteur ne change jamais
        return response()->json($item);
    }

    public function destroy($reports)
    {
        $item = Reports::findOrFail($reports);
        $item->delete();
        return response()->json(null, 204);
    }

    /**
     * PATCH /api/admin/reports/{id}/resolve
     * Body: { "resolution_note": "..." } (optionnel)
     * Admin-only. Notifie l'auteur du signalement que c'est traité.
     */
    public function resolve(Request $request, $reports)
    {
        $data = $request->validate([
            'resolution_note' => 'nullable|string|max:500',
        ]);

        $item = Reports::findOrFail($reports);
        $item->update(['State' => self::STATE_RESOLVED]);

        if ($item->IdUser) {
            $this->notifications->send(
                $item->IdUser,
                'Réclamation traitée',
                $data['resolution_note'] ?? "Votre signalement \"{$item->Subject}\" a été traité.",
                NotificationService::TYPE_REPORT_RESOLVED
            );
        }

        return response()->json(['message' => 'Report resolved.', 'data' => $item]);
    }

    /**
     * PATCH /api/admin/reports/{id}/reject
     * Admin-only. Signalement jugé non fondé.
     */
    public function rejectReport(Request $request, $reports)
    {
        $data = $request->validate([
            'resolution_note' => 'nullable|string|max:500',
        ]);

        $item = Reports::findOrFail($reports);
        $item->update(['State' => self::STATE_REJECTED]);

        if ($item->IdUser) {
            $this->notifications->send(
                $item->IdUser,
                'Réclamation rejetée',
                $data['resolution_note'] ?? "Votre signalement \"{$item->Subject}\" a été examiné et rejeté.",
                NotificationService::TYPE_REPORT_RESOLVED
            );
        }

        return response()->json(['message' => 'Report rejected.', 'data' => $item]);
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
