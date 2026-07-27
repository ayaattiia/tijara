<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
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
            Payments::class,
            ['Reference'],
            ['IdUser', 'IdOrder', 'Method', 'Status', 'TransactionId'],
            ['Amount', 'CreatedAt', 'PaidAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Payments::create($data);
        return response()->json($item, 201);
    }

    public function show($payments)
    {
        $item = Payments::findOrFail($payments);
        return response()->json($item);
    }

    public function update(Request $request, $payments)
    {
        $item = Payments::findOrFail($payments);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($payments)
    {
        $item = Payments::findOrFail($payments);
        $item->delete();
        return response()->json(null, 204);
    }

    /**
     * GET /api/payments/order/{idOrder}
     * List all payment attempts/transactions for an order (retries, partials, etc).
     */
    public function orderPayments($idOrder)
    {
        $payments = Payments::where('IdOrder', $idOrder)
            ->orderByDesc('CreatedAt')
            ->get();

        return response()->json([
            'success' => true,
            'IdOrder' => (int) $idOrder,
            'count' => $payments->count(),
            'data' => $payments
        ]);
    }

    /**
     * GET /api/payments/user/{idUser}
     * Payment history for a specific customer.
     */
    public function userPayments($idUser)
    {
        $payments = Payments::where('IdUser', $idUser)
            ->orderByDesc('CreatedAt')
            ->get();

        return response()->json([
            'success' => true,
            'IdUser' => (int) $idUser,
            'count' => $payments->count(),
            'data' => $payments
        ]);
    }

    /**
     * POST /api/payments/{id}/complete
     * Mark a payment as completed (e.g. after gateway callback confirms success).
     */
    public function markCompleted($id)
    {
        $payment = Payments::find($id);

        if (!$payment) {

            return response()->json([
                'success' => false,
                'message' => 'Payment not found.'
            ], 404);
        }

        if ($payment->Status == 'paid') {

            return response()->json([
                'success' => false,
                'message' => 'Payment already completed.'
            ], 400);
        }

        $payment->Status = 'paid';
        $payment->PaidAt = now();
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment marked as completed.',
            'data' => $payment
        ]);
    }

    /**
     * POST /api/payments/{id}/refund
     */
    public function refund($id)
    {
        $payment = Payments::find($id);

        if (!$payment) {

            return response()->json([
                'success' => false,
                'message' => 'Payment not found.'
            ], 404);
        }

        if ($payment->Status != 'paid') {

            return response()->json([
                'success' => false,
                'message' => 'Only completed payments can be refunded.'
            ], 400);
        }

        $payment->Status = 'Refunded';
        $payment->save();


        return response()->json([
            'success' => true,
            'message' => 'Payment refunded.',
            'data' => $payment
        ]);
    }

    /**
     * GET /api/payments/order/{idOrder}/total
     * Sum of all completed payments for an order — useful to check
     * partial-payment orders against the invoice Total.
     */
    public function totalPaid($idOrder)
    {
        $total = Payments::where('IdOrder', $idOrder)
            ->where('Status', 'paid')
            ->sum('Amount');

        return response()->json([
            'success' => true,
            'IdOrder' => (int) $idOrder,
            'totalPaid' => round($total, 3)
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
