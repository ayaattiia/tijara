<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Deals;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderDetailsController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 1;
    private const MAX_PER_PAGE = 50;

    /**
     * GET /api/order-details
     */
    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            OrderDetails::class,
            [
                'ZipCode',
                'Address',
                'Email',
                'Telephone',
                'FirstName',
                'LastName'
            ],
            [
                'IdUser',
                'IdProduct',
                'IdState',
                'IdCountry',
                'IdOrder',
                'Active'
            ],
            [
                'Quantity',
                'UnitPrice',
                'DateTimeCommand'
            ]
        );

        return response()->json(
            $query->paginate($perPage)
        );
    }

    /**
     * POST /api/order-details
     *
     * Creates an order detail and reserves/decreases stock.
     *
     * Normal product:
     * Products.QuantityProduct -= Quantity
     *
     * Deal:
     * Deals.quantity -= Quantity
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'IdOrder' => 'required|exists:Orders,IdOrder',

            'IdProduct' => 'required|exists:Products,IdProduct',

            'Quantity' => 'required|integer|min:1',

            /*
             * UnitPrice is accepted for compatibility but NEVER trusted.
             * The real price is always taken from the database.
             */
            'UnitPrice' => 'nullable|numeric|min:0',

            'IdUser' => 'nullable|exists:Users,IdUser',

            'IdState' => 'nullable|exists:States,IdState',

            'IdCountry' => 'nullable|exists:Countries,IdCountry',

            'ZipCode' => 'nullable|string|max:20',

            'Address' => 'nullable|string|max:255',

            'Email' => 'nullable|email|max:255',

            'Telephone' => 'nullable|string|max:20',

            'FirstName' => 'nullable|string|max:100',

            'LastName' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        /*
         * Get the parent order.
         */
        $order = Orders::findOrFail($data['IdOrder']);

        /*
         * Do not allow adding details to a finished/cancelled order.
         */
        if (in_array($order->Status, [
            'cancelled',
            'rejected',
            'delivered'
        ], true)) {
            return response()->json([
                'success' => false,
                'message' => "Cannot add products to an order with status '{$order->Status}'."
            ], 422);
        }

        try {

            $item = DB::transaction(function () use ($data, $order) {

                /*
                 * ==========================================================
                 * DEAL ORDER
                 * ==========================================================
                 */
                if (!empty($order->IdDeal)) {

                    $deal = Deals::lockForUpdate()
                        ->findOrFail($order->IdDeal);

                    $remaining = (int) $deal->quantity;
                    $requested = (int) $data['Quantity'];

                    if ($remaining < $requested) {
                        abort(
                            409,
                            'Stock insuffisant pour ce deal.'
                        );
                    }

                    /*
                     * Decrease deal stock.
                     */
                    $newQuantity = $remaining - $requested;

                    $deal->quantity = (string) $newQuantity;

                    /*
                     * Check deal expiration safely.
                     */
                    $dealExpired = false;

                    if (!empty($deal->dateEnd)) {
                        try {
                            $dealExpired = now()->greaterThan(
                                Carbon::parse($deal->dateEnd)
                            );
                        } catch (\Exception $e) {
                            /*
                             * Invalid legacy date:
                             * don't automatically consider it expired.
                             */
                            $dealExpired = false;
                        }
                    }

                    /*
                     * If no stock remains or deal expired,
                     * deactivate it.
                     */
                    if ($newQuantity <= 0 || $dealExpired) {
                        $deal->active = 0;
                    }

                    $deal->save();

                    /*
                     * NEVER trust client price.
                     */
                    $data['UnitPrice'] = (float) $deal->priceDeal;

                    return OrderDetails::create($data);
                }

                /*
                 * ==========================================================
                 * NORMAL PRODUCT ORDER
                 * ==========================================================
                 */

                $product = Products::lockForUpdate()
                    ->findOrFail($data['IdProduct']);

                $remaining = (int) $product->QuantityProduct;
                $requested = (int) $data['Quantity'];

                if ($remaining < $requested) {
                    abort(
                        409,
                        'Stock insuffisant pour ce produit.'
                    );
                }

                /*
                 * Decrease product stock.
                 */
                $newQuantity = $remaining - $requested;

                $product->QuantityProduct = $newQuantity;

                /*
                 * No stock = inactive.
                 */
                if ($newQuantity <= 0) {
                    $product->Active = 0;
                }

                $product->save();

                /*
                 * NEVER trust client price.
                 */
                $data['UnitPrice'] = (float) $product->PriceProduct;

                return OrderDetails::create($data);
            });
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        } catch (\Throwable $e) {

            report($e);

            $response = [
                'success' => false,
                'message' =>
                'Something went wrong while processing this order detail.',
            ];

            if (config('app.debug')) {
                $response['debug'] = [
                    'exception' => get_class($e),
                    'message'   => $e->getMessage(),
                    'file'      => $e->getFile(),
                    'line'      => $e->getLine(),
                ];
            }

            return response()->json($response, 500);
        }

        return response()->json([
            'success' => true,
            'data' => $item->load('product')
        ], 201);
    }

    /**
     * GET /api/order-details/{order_details}
     */
    public function show($order_details)
    {
        $item = OrderDetails::with('product')
            ->findOrFail($order_details);

        return response()->json($item);
    }

    /**
     * PUT/PATCH /api/order-details/{order_details}
     *
     * IMPORTANT:
     * Quantity, IdProduct and IdOrder cannot be changed here.
     *
     * Changing Quantity after stock was already reserved would
     * create stock inconsistencies.
     */
    public function update(Request $request, $order_details)
    {
        $item = OrderDetails::findOrFail($order_details);

        $validator = Validator::make($request->all(), [

            /*
             * These are intentionally NOT allowed to change:
             *
             * IdOrder
             * IdProduct
             * Quantity
             * UnitPrice
             *
             * because stock was already reserved when the detail
             * was created.
             */

            'IdUser' => 'nullable|exists:Users,IdUser',

            'IdState' => 'nullable|exists:States,IdState',

            'IdCountry' => 'nullable|exists:Countries,IdCountry',

            'ZipCode' => 'nullable|string|max:20',

            'Address' => 'nullable|string|max:255',

            'Email' => 'nullable|email|max:255',

            'Telephone' => 'nullable|string|max:20',

            'FirstName' => 'nullable|string|max:100',

            'LastName' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $item->update(
            $validator->validated()
        );

        return response()->json([
            'success' => true,
            'data' => $item->load('product')
        ]);
    }

    /**
     * DELETE /api/order-details/{order_details}
     *
     * We don't automatically restore stock here.
     *
     * Stock must be restored through:
     *
     * pending -> cancelled
     * pending -> rejected
     *
     * Otherwise deleting an OrderDetail directly could create
     * inconsistent stock.
     */
    public function destroy($order_details)
    {
        $item = OrderDetails::findOrFail($order_details);

        return response()->json([
            'success' => false,
            'message' =>
            'Order details cannot be deleted directly. Cancel or reject the order to restore stock.'
        ], 422);
    }

    /**
     * GET /api/order-details/total/{idOrder}
     *
     * Calculates total using the UnitPrice saved at order time.
     *
     * This is better than using the current product price because
     * the product price may change after the order was created.
     */
    public function total($idOrder)
    {
        $details = OrderDetails::where('IdOrder', $idOrder)
            ->get();

        $total = $details->sum(function ($detail) {
            return (float) $detail->UnitPrice *
                (int) $detail->Quantity;
        });

        return response()->json([
            'IdOrder' => (int) $idOrder,
            'total' => round($total, 2),
        ]);
    }

    /**
     * Resolve pagination.
     */
    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query(
            'per_page',
            self::DEFAULT_PER_PAGE
        );

        return max(
            self::MIN_PER_PAGE,
            min($perPage, self::MAX_PER_PAGE)
        );
    }

    /**
     * Build filtered query.
     *
     * Keep your existing implementation if this method already
     * exists in your Controller/BaseController.
     */
    protected function buildFilteredQuery(
        Request $request,
        string $model,
        array $searchableFields = [],
        array $filterableFields = [],
        array $sortableFields = []
    ) {
        $query = $model::query();

        /*
         * Search.
         */
        if ($request->filled('search')) {

            $search = $request->query('search');

            $query->where(function ($q) use (
                $search,
                $searchableFields
            ) {

                foreach ($searchableFields as $field) {
                    $q->orWhere(
                        $field,
                        'LIKE',
                        '%' . $search . '%'
                    );
                }
            });
        }

        /*
         * Exact filters.
         */
        foreach ($filterableFields as $field) {

            if ($request->filled($field)) {
                $query->where(
                    $field,
                    $request->query($field)
                );
            }
        }

        /*
         * Sorting.
         */
        if ($request->filled('sort_by')) {

            $sortBy = $request->query('sort_by');

            if (in_array($sortBy, $sortableFields, true)) {

                $direction = strtolower(
                    $request->query('sort_direction', 'desc')
                );

                $direction = in_array(
                    $direction,
                    ['asc', 'desc'],
                    true
                )
                    ? $direction
                    : 'desc';

                $query->orderBy(
                    $sortBy,
                    $direction
                );
            }
        }

        return $query;
    }
}
