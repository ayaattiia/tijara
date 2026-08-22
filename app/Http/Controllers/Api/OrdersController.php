<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Services\NotificationService;
use Illuminate\Http\Request;


class OrdersController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function __construct(private NotificationService $notifications) {}

    private const VALID_STATUSES = ['pending', 'accepted', 'rejected', 'shipped', 'delivered', 'cancelled'];

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = Orders::query();

        // Admins (Section 4 apiResource) see everything. Regular buyers
        // (Section 2) only ever see their own orders here.
        if ($request->user()->IdRole != 3) {
            $query->where('IdUser', $request->user()->IdUser);
        }

        if ($request->filled('Status')) {
            $query->where('Status', $request->query('Status'));
        }

        return response()->json($query->latest('IdOrder')->paginate($perPage));
    }

    /**
     * POST /api/orders
     * Buyer places an order. IdUser is always taken from the authenticated
     * token, never trusted from the request body.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'IdDeal'  => 'nullable|exists:Deals,IdDeal',
            'IdState' => 'nullable|exists:States,IdState',
        ]);

        $item = Orders::create([
            'IdUser'          => $request->user()->IdUser,
            'IdDeal'          => $data['IdDeal'] ?? null,
            'IdState'         => $data['IdState'] ?? null,
            'Status'          => 'pending',
            'DateTimeCommand' => now(),
            'Active'          => 1,
        ]);

        return response()->json($item, 201);
    }

    public function show($orders)
    {
        $item = Orders::with('details.product')->findOrFail($orders);
        return response()->json($item);
    }

    public function update(Request $request, $orders)
    {
        $item = Orders::findOrFail($orders);
        $item->update($request->except(['IdUser', 'Status'])); // Status changes only via accept/reject/ship/cancel/admin
        return response()->json($item);
    }

    public function destroy($orders)
    {
        $item = Orders::findOrFail($orders);
        $item->delete();
        return response()->json(null, 204);
    }

    /**
     * PATCH /api/orders/{order}/cancel
     * Buyer cancels their own order - only while still 'pending'.
     */
    public function cancel(Request $request, $order)
    {
        $item = Orders::findOrFail($order);

        if ($item->IdUser != $request->user()->IdUser) {
            return response()->json(['message' => 'This is not your order.'], 403);
        }

        if ($item->Status !== 'pending') {
            return response()->json(['message' => "Order can only be cancelled while still pending (current: {$item->Status})."], 422);
        }

        $item->update(['Status' => 'cancelled']);

        // Notifie le(s) vendeur(s) concerné(s) par cette commande
        $item->load('details.product');
        $sellerIds = $item->details->pluck('product.IdUser')->filter()->unique();
        foreach ($sellerIds as $sellerId) {
            $this->notifications->send(
                $sellerId,
                'Commande annulée',
                "La commande #{$item->IdOrder} a été annulée par l'acheteur.",
                NotificationService::TYPE_ORDER_CANCELLED
            );
        }

        return response()->json(['message' => 'Order cancelled.', 'data' => $item]);
    }

    /**
     * GET /api/orders/seller
     * Vendor's received orders - any order containing at least one of
     * their own products.
     */
    public function sellerOrders(Request $request)
    {
        $perPage = $this->resolvePerPage($request);
        $sellerId = $request->user()->IdUser;

        $query = Orders::whereHas('details.product', function ($q) use ($sellerId) {
            $q->where('IdUser', $sellerId);
        })->with(['details' => function ($q) use ($sellerId) {
            $q->whereHas('product', fn($p) => $p->where('IdUser', $sellerId))->with('product');
        }]);

        if ($request->filled('Status')) {
            $query->where('Status', $request->query('Status'));
        }

        return response()->json($query->latest('IdOrder')->paginate($perPage));
    }

    /**
     * PATCH /api/orders/{order}/accept
     * Vendor accepts an order containing at least one of their products.
     */
    public function accept(Request $request, $order)
    {
        return $this->transitionAsSeller($request, $order, 'pending', 'accepted');
    }

    /**
     * PATCH /api/orders/{order}/reject
     */
    public function reject(Request $request, $order)
    {
        return $this->transitionAsSeller($request, $order, 'pending', 'rejected');
    }

    /**
     * PATCH /api/orders/{order}/ship
     */
    public function markShipped(Request $request, $order)
    {
        return $this->transitionAsSeller($request, $order, 'accepted', 'shipped');
    }

    private function transitionAsSeller(Request $request, $order, string $fromStatus, string $toStatus)
    {
        $item = Orders::with('details.product')->findOrFail($order);
        $sellerId = $request->user()->IdUser;

        $ownsAProduct = $item->details->contains(function ($detail) use ($sellerId) {
            return $detail->product && $detail->product->IdUser == $sellerId;
        });

        if (! $ownsAProduct) {
            return response()->json(['message' => 'This order does not contain any of your products.'], 403);
        }

        if ($item->Status !== $fromStatus) {
            return response()->json([
                'message' => "Order must be '{$fromStatus}' to move to '{$toStatus}' (current: {$item->Status}).",
            ], 422);
        }

        $item->update(['Status' => $toStatus]);

        $labels = [
            'accepted' => ['Commande acceptée', 'Votre commande #%d a été acceptée par le vendeur.', NotificationService::TYPE_ORDER_ACCEPTED],
            'rejected' => ['Commande refusée', 'Votre commande #%d a été refusée par le vendeur.', NotificationService::TYPE_ORDER_REJECTED],
            'shipped'  => ['Commande expédiée', 'Votre commande #%d a été expédiée.', NotificationService::TYPE_ORDER_SHIPPED],
        ];

        if (isset($labels[$toStatus])) {
            [$title, $descriptionFormat, $type] = $labels[$toStatus];
            $this->notifications->send(
                $item->IdUser,
                $title,
                sprintf($descriptionFormat, $item->IdOrder),
                $type
            );
        }

        return response()->json(['message' => "Order marked as {$toStatus}.", 'data' => $item]);
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
