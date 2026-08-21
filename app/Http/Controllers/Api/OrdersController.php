<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\Products;
use App\Models\Deals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 1;
    private const MAX_PER_PAGE = 50;

    private const VALID_STATUSES = [
        'pending',
        'accepted',
        'rejected',
        'shipped',
        'delivered',
        'cancelled'
    ];

    /**
     * GET /api/orders
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = Orders::query();

        /*
         * Admin sees all orders.
         * Normal user sees only his orders.
         */
        if ($request->user()->IdRole != 3) {
            $query->where(
                'IdUser',
                $request->user()->IdUser
            );
        }

        if ($request->filled('Status')) {
            $query->where(
                'Status',
                $request->query('Status')
            );
        }

        return response()->json(
            $query
                ->latest('IdOrder')
                ->paginate($perPage)
        );
    }

    /**
     * POST /api/orders
     *
     * Creates the order.
     *
     * Stock is NOT decreased here.
     * Stock is decreased when OrderDetails are created.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'IdDeal' => 'nullable|exists:Deals,IdDeal',
            'IdState' => 'nullable|exists:States,IdState',
        ]);

        $item = Orders::create([
            'IdUser' => $request->user()->IdUser,
            'IdDeal' => $data['IdDeal'] ?? null,
            'IdState' => $data['IdState'] ?? null,
            'Status' => 'pending',
            'DateTimeCommand' => now(),
            'Active' => 1,
        ]);

        return response()->json(
            $item,
            201
        );
    }

    /**
     * GET /api/orders/{id}
     */
    public function show($orders)
    {
        $item = Orders::with(
            'details.product'
        )->findOrFail($orders);

        return response()->json($item);
    }

    /**
     * PATCH /api/orders/{id}
     *
     * General update.
     *
     * Status cannot be changed here.
     */
    public function update(Request $request, $orders)
    {
        $item = Orders::findOrFail($orders);

        $item->update(
            $request->except([
                'IdUser',
                'Status',
                'IdDeal'
            ])
        );

        return response()->json($item);
    }

    /**
     * DELETE /api/orders/{id}
     *
     * Do not allow deleting orders because
     * their stock may already have been reserved.
     */
    public function destroy($orders)
    {
        return response()->json([
            'success' => false,
            'message' =>
            'Orders cannot be deleted directly. Cancel the order instead.'
        ], 422);
    }

    /**
     * PATCH /api/orders/{order}/cancel
     *
     * Buyer cancels a pending order.
     *
     * pending
     *    ↓
     * cancelled
     *
     * AND stock is restored.
     */
    public function cancel(Request $request, $order)
    {
        return DB::transaction(function () use ($request, $order) {

            /*
             * LOCK THE ORDER.
             *
             * This prevents two requests from cancelling
             * the same order at the same time.
             */
            $item = Orders::lockForUpdate()
                ->with('details')
                ->findOrFail($order);

            /*
             * Only the buyer can cancel.
             */
            if (
                $item->IdUser !=
                $request->user()->IdUser
            ) {
                return response()->json([
                    'message' =>
                    'This is not your order.'
                ], 403);
            }

            /*
             * Only pending orders can be cancelled.
             */
            if ($item->Status !== 'pending') {
                return response()->json([
                    'message' =>
                    "Order can only be cancelled while still pending " .
                        "(current: {$item->Status})."
                ], 422);
            }

            /*
             * RESTORE STOCK FIRST.
             */
            $this->restoreOrderStock($item);

            /*
             * Then change status.
             */
            $item->Status = 'cancelled';
            $item->save();

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled and stock restored.',
                'data' => $item->load('details.product')
            ]);
        });
    }

    /**
     * GET /api/orders/seller
     */
    public function sellerOrders(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $sellerId = $request->user()->IdUser;

        $query = Orders::whereHas(
            'details.product',
            function ($q) use ($sellerId) {
                $q->where(
                    'IdUser',
                    $sellerId
                );
            }
        )->with([
            'details' => function ($q) use ($sellerId) {

                $q->whereHas(
                    'product',
                    fn($p) =>
                    $p->where(
                        'IdUser',
                        $sellerId
                    )
                )->with('product');
            }
        ]);

        if ($request->filled('Status')) {
            $query->where(
                'Status',
                $request->query('Status')
            );
        }

        return response()->json(
            $query
                ->latest('IdOrder')
                ->paginate($perPage)
        );
    }

    /**
     * PATCH /api/orders/{order}/accept
     */
    public function accept(
        Request $request,
        $order
    ) {
        return $this->transitionAsSeller(
            $request,
            $order,
            'pending',
            'accepted'
        );
    }

    /**
     * PATCH /api/orders/{order}/reject
     *
     * pending
     *    ↓
     * rejected
     *
     * Stock is restored.
     */
    public function reject(
        Request $request,
        $order
    ) {
        return DB::transaction(function () use (
            $request,
            $order
        ) {

            /*
             * Lock order to prevent double processing.
             */
            $item = Orders::lockForUpdate()
                ->with('details.product')
                ->findOrFail($order);

            $sellerId =
                $request->user()->IdUser;

            /*
             * Verify seller owns at least one
             * product in this order.
             */
            $ownsAProduct =
                $item->details->contains(
                    function ($detail) use ($sellerId) {

                        return $detail->product &&
                            $detail->product->IdUser ==
                            $sellerId;
                    }
                );

            if (!$ownsAProduct) {
                return response()->json([
                    'message' =>
                    'This order does not contain any of your products.'
                ], 403);
            }

            /*
             * Only pending orders can be rejected.
             */
            if ($item->Status !== 'pending') {
                return response()->json([
                    'message' =>
                    "Order must be 'pending' to be rejected " .
                        "(current: {$item->Status})."
                ], 422);
            }

            /*
             * RESTORE STOCK.
             */
            $this->restoreOrderStock($item);

            /*
             * Change status.
             */
            $item->Status = 'rejected';
            $item->save();

            return response()->json([
                'success' => true,
                'message' =>
                'Order rejected and stock restored.',
                'data' =>
                $item->load('details.product')
            ]);
        });
    }

    /**
     * PATCH /api/orders/{order}/ship
     */
    public function markShipped(
        Request $request,
        $order
    ) {
        return $this->transitionAsSeller(
            $request,
            $order,
            'accepted',
            'shipped'
        );
    }

    /**
     * Seller status transition.
     */
    private function transitionAsSeller(
        Request $request,
        $order,
        string $fromStatus,
        string $toStatus
    ) {
        return DB::transaction(function () use (
            $request,
            $order,
            $fromStatus,
            $toStatus
        ) {

            /*
             * Lock the order.
             */
            $item = Orders::lockForUpdate()
                ->with('details.product')
                ->findOrFail($order);

            $sellerId =
                $request->user()->IdUser;

            /*
             * Verify seller owns a product
             * in this order.
             */
            $ownsAProduct =
                $item->details->contains(
                    function ($detail) use ($sellerId) {

                        return $detail->product &&
                            $detail->product->IdUser ==
                            $sellerId;
                    }
                );

            if (!$ownsAProduct) {
                return response()->json([
                    'message' =>
                    'This order does not contain any of your products.'
                ], 403);
            }

            /*
             * Verify correct transition.
             */
            if ($item->Status !== $fromStatus) {

                return response()->json([
                    'message' =>
                    "Order must be '{$fromStatus}' " .
                        "to move to '{$toStatus}' " .
                        "(current: {$item->Status}).",
                ], 422);
            }

            /*
             * accepted / shipped do NOT restore stock.
             */
            $item->Status = $toStatus;
            $item->save();

            return response()->json([
                'success' => true,
                'message' =>
                "Order marked as {$toStatus}.",
                'data' =>
                $item->load('details.product')
            ]);
        });
    }

    /**
     * RESTORE STOCK FOR AN ORDER.
     *
     * This method is used only when:
     *
     * pending → cancelled
     *
     * OR
     *
     * pending → rejected
     *
     * Product:
     *     QuantityProduct += ordered quantity
     *
     * Deal:
     *     quantity += ordered quantity
     */
    private function restoreOrderStock(Orders $order)
    {
        /*
         * Get all order details.
         */
        $details = OrderDetails::where(
            'IdOrder',
            $order->IdOrder
        )->get();

        /*
         * Nothing to restore.
         */
        if ($details->isEmpty()) {
            return;
        }

        /*
         * DEAL ORDER
         */
        if (!empty($order->IdDeal)) {

            $deal = Deals::lockForUpdate()
                ->find($order->IdDeal);

            if (!$deal) {
                return;
            }

            /*
             * Sum all quantities belonging to
             * this order.
             */
            $totalQuantity =
                $details->sum('Quantity');

            /*
             * Restore deal stock.
             */
            $deal->quantity =
                (int) $deal->quantity +
                (int) $totalQuantity;

            /*
             * Reactivate the deal if:
             *
             * - stock > 0
             * - date has not expired
             */
            $expired = false;

            if (!empty($deal->dateEnd)) {
                try {
                    $expired =
                        now()->greaterThan(
                            \Carbon\Carbon::parse(
                                $deal->dateEnd
                            )
                        );
                } catch (\Exception $e) {
                    $expired = false;
                }
            }

            if (
                (int) $deal->quantity > 0 &&
                !$expired
            ) {
                $deal->active = 1;
            }

            $deal->save();

            return;
        }

        /*
         * NORMAL PRODUCTS
         *
         * Each detail can refer to a different product.
         */
        foreach ($details as $detail) {

            $product = Products::lockForUpdate()
                ->find($detail->IdProduct);

            if (!$product) {
                continue;
            }

            /*
             * Restore quantity.
             */
            $product->QuantityProduct =
                (int) $product->QuantityProduct +
                (int) $detail->Quantity;

            /*
             * Product becomes active again
             * because stock is available.
             */
            if (
                (int) $product->QuantityProduct > 0
            ) {
                $product->Active = 1;
            }

            $product->save();
        }
    }

    /**
     * Pagination.
     */
    private function resolvePerPage(
        Request $request
    ): int {
        $perPage = (int) $request->query(
            'per_page',
            self::DEFAULT_PER_PAGE
        );

        return max(
            self::MIN_PER_PAGE,
            min(
                $perPage,
                self::MAX_PER_PAGE
            )
        );
    }
}
