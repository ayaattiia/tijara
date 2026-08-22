<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Deals;
use App\Models\Orders;
use App\Models\Products;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class OrderDetailsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function __construct(private NotificationService $notifications) {}

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            OrderDetails::class,
            ['ZipCode', 'Address', 'Email', 'Telephone', 'FirstName', 'LastName'],
            ['IdUser', 'IdProduct', 'IdState', 'IdCountry', 'IdOrder', 'Active'],
            ['Quantity', 'UnitPrice', 'DateTimeCommand']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'IdOrder' => 'required|exists:Orders,IdOrder',

            'IdProduct' => 'required|exists:Products,IdProduct',

            'Quantity' => 'required|integer|min:1',

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

        // L'Order parente porte déjà IdDeal (si cette commande concerne un deal).
        // On regarde là, pas sur OrderDetails, pour savoir s'il faut décrémenter.
        $order = Orders::findOrFail($data['IdOrder']);

        try {
            if (!empty($order->IdDeal)) {
                $item = DB::transaction(function () use ($data, $order) {
                    $deal = Deals::lockForUpdate()->findOrFail($order->IdDeal);
                    $remaining = (int) $deal->quantity;
                    $requested = (int) $data['Quantity'];

                    if ($remaining < $requested) {
                        abort(409, 'Stock insuffisant pour ce deal.');
                    }

                    $deal->quantity = (string) ($remaining - $requested);

                    // dateEnd is a plain varchar in the DB, not a real date
                    // column - it can contain empty/malformed values from
                    // legacy data entry. Parse defensively so a bad value
                    // never throws an uncaught InvalidFormatException.
                    $dealExpired = false;
                    if (!empty($deal->dateEnd)) {
                        try {
                            $dealExpired = now()->greaterThan(\Carbon\Carbon::parse($deal->dateEnd));
                        } catch (\Exception $e) {
                            $dealExpired = false; // unparsable date -> don't treat as expired
                        }
                    }

                    if (($remaining - $requested) <= 0 || $dealExpired) {
                        $deal->active = 0;
                    }
                    $deal->save();

                    // UnitPrice is NOT NULL with no DB default. Never trust
                    // a client-supplied price (tampering risk) - always
                    // compute it from the deal's real price server-side.
                    $data['UnitPrice'] = (float) $deal->priceDeal;

                    return OrderDetails::create($data);
                });
            } else {
                // Commande sur un produit normal (pas de deal) : on
                // décrémente QuantityProduct de la même façon.
                $item = DB::transaction(function () use ($data) {
                    $product = Products::lockForUpdate()->findOrFail($data['IdProduct']);
                    $remaining = (int) $product->QuantityProduct;
                    $requested = (int) $data['Quantity'];

                    if ($remaining < $requested) {
                        abort(409, 'Stock insuffisant pour ce produit.');
                    }

                    $product->QuantityProduct = $remaining - $requested;
                    if ($product->QuantityProduct <= 0) {
                        $product->Active = 0; // rupture de stock -> masqué du catalogue
                    }
                    $product->save();

                    // Same reasoning as the deal branch above: always
                    // compute UnitPrice server-side from the real price.
                    $data['UnitPrice'] = (float) $product->PriceProduct;

                    return OrderDetails::create($data);
                });
            }
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        } catch (\Throwable $e) {
            report($e); // still logged to storage/logs/laravel.log for debugging

            // TEMPORARY: always show debug info here regardless of
            // APP_DEBUG, to rule out stale config/cache while diagnosing.
            $response = [
                'success' => false,
                'message' => 'Something went wrong while processing this order detail.',
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

        // Notifie le vendeur propriétaire du produit qu'une commande a été reçue
        $item->load('product');
        if ($item->product && $item->product->IdUser) {
            $this->notifications->send(
                $item->product->IdUser,
                'Nouvelle commande reçue',
                "Commande de {$item->Quantity}x \"{$item->product->TitleProduct}\" (commande #{$item->IdOrder}).",
                NotificationService::TYPE_ORDER_RECEIVED
            );
        }

        return response()->json([
            'success' => true,
            'data' => $item->load('product')
        ], 201);
    }

    public function show($order_details)
    {
        $item = OrderDetails::findOrFail($order_details);
        return response()->json($item);
    }

    public function update(Request $request, $order_details)
    {
        $item = OrderDetails::findOrFail($order_details);

        $validator = Validator::make($request->all(), [

            'IdOrder' => 'sometimes|required|exists:Orders,IdOrder',

            'IdProduct' => 'sometimes|required|exists:Products,IdProduct',

            'Quantity' => 'sometimes|required|integer|min:1',

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

        $item->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $item->load('product')
        ]);
    }

    public function destroy($order_details)
    {
        $item = OrderDetails::findOrFail($order_details);
        $item->delete();
        return response()->json(null, 204);
    }
    /**
     * GET /api/order-details/total/{idOrder}
     * Returns the total price of all products in the given order.
     */
    public function total($idOrder)
    {
        $details = OrderDetails::with('product')
            ->where('IdOrder', $idOrder)
            ->get();

        $total = $details->sum(function ($detail) {
            return $detail->product->PriceProduct * $detail->Quantity;
        });

        return response()->json([
            'IdOrder' => (int) $idOrder,
            'total'   => round($total, 2),
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
