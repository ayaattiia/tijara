<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transports;
use App\Models\Deliveries;
use Illuminate\Http\Request;

class TransportsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Transports::class,
            ['Name', 'Logo', 'Phone', 'Email', 'Zones'],
            ['FreeFrom', 'Active'],
            ['DeliveryFee', 'CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Transports::create($data);
        return response()->json($item, 201);
    }

    public function show($transports)
    {
        $item = Transports::findOrFail($transports);
        return response()->json($item);
    }

    public function update(Request $request, $transports)
    {
        $item = Transports::findOrFail($transports);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($transports)
    {
        $item = Transports::findOrFail($transports);
        $item->delete();
        return response()->json(null, 204);
    }

    /**
     * GET /api/transports/order/{idOrder}
     * List every distinct carrier that has a package assigned to this order.
     * Proves one order can be split across multiple couriers.
     */
    public function orderTransports($idOrder)
    {
        $transportIds = Deliveries::where('IdOrder', $idOrder)
            ->pluck('IdTransport')
            ->unique();

        $transports = Transports::whereIn('IdTransport', $transportIds)->get();

        return response()->json([
            'success' => true,
            'IdOrder' => (int) $idOrder,
            'count' => $transports->count(),
            'data' => $transports
        ]);
    }

    /**
     * GET /api/transports/date-range?from=2026-07-01&to=2026-07-15&per_page=10&page=1
     * Plage of transports created between two dates, paginated.
     */
    public function dateRange(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to'   => 'required|date|after_or_equal:from'
        ]);

        $perPage = $this->resolvePerPage($request);

        $transports = Transports::whereDate('CreatedAt', '>=', $request->from)
            ->whereDate('CreatedAt', '<=', $request->to)
            ->orderBy('CreatedAt')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'from' => $request->from,
            'to' => $request->to,
            'data' => $transports
        ]);
    }

    /**
     * GET /api/transports/{id}/deliveries
     * All packages currently assigned to a given carrier.
     */
    public function transportDeliveries($id)
    {
        $transport = Transports::find($id);

        if (!$transport) {

            return response()->json([
                'success' => false,
                'message' => 'Transport not found.'
            ], 404);
        }

        $deliveries = Deliveries::where('IdTransport', $id)
            ->orderByDesc('CreatedAt')
            ->get();

        return response()->json([
            'success' => true,
            'IdTransport' => (int) $id,
            'count' => $deliveries->count(),
            'data' => $deliveries
        ]);
    }

    /**
     * POST /api/transports/{id}/toggle-active
     * Enable/disable a carrier without deleting it (e.g. temporarily out of service).
     */
    public function toggleActive($id)
    {
        $transport = Transports::find($id);

        if (!$transport) {

            return response()->json([
                'success' => false,
                'message' => 'Transport not found.'
            ], 404);
        }

        $transport->Active = !$transport->Active;
        $transport->save();

        return response()->json([
            'success' => true,
            'message' => 'Transport status toggled.',
            'data' => $transport
        ]);
    }

    /**
     * GET /api/transports/{id}/stats
     * Quick performance snapshot: total deliveries, delivered count, pending count.
     */
    public function stats($id)
    {
        $transport = Transports::find($id);

        if (!$transport) {

            return response()->json([
                'success' => false,
                'message' => 'Transport not found.'
            ], 404);
        }

        $total = Deliveries::where('IdTransport', $id)->count();
        $delivered = Deliveries::where('IdTransport', $id)->where('Status', 'Delivered')->count();
        $pending = Deliveries::where('IdTransport', $id)->where('Status', '!=', 'Delivered')->count();

        return response()->json([
            'success' => true,
            'IdTransport' => (int) $id,
            'totalDeliveries' => $total,
            'delivered' => $delivered,
            'pending' => $pending
        ]);
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
