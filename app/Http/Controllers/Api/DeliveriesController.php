<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deliveries;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
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
            Deliveries::class,
            ['TrackingNumber', 'AddressLine', 'City', 'PostalCode', 'Phone', 'Note'],
            ['IdOrder', 'IdTransport', 'Status'],
            ['DeliveryFee', 'EstimatedAt', 'DeliveredAt', 'CreatedAt', 'UpdatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Deliveries::create($data);
        return response()->json($item, 201);
    }

    public function show($deliveries)
    {
        $item = Deliveries::findOrFail($deliveries);
        return response()->json($item);
    }

    public function update(Request $request, $deliveries)
    {
        $item = Deliveries::findOrFail($deliveries);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($deliveries)
    {
        $item = Deliveries::findOrFail($deliveries);
        $item->delete();
        return response()->json(null, 204);
    }
    /**
     * GET /api/deliveries/order/{idOrder}
     * List every package/colis shipped for a given order.
     * Since delivery is per-colis (not per-order), one order can have many rows here.
     */
    public function orderDeliveries($idOrder)
    {
        $deliveries = Deliveries::where('IdOrder', $idOrder)
            ->orderByDesc('CreatedAt')
            ->get();

        return response()->json([
            'success' => true,
            'IdOrder' => (int) $idOrder,
            'count' => $deliveries->count(),
            'data' => $deliveries
        ]);
    }

    /**
     * GET /api/deliveries/track/{trackingNumber}
     * Look up a single package by its tracking number (customer-facing tracking page).
     */
    public function track($trackingNumber)
    {
        $delivery = Deliveries::where('TrackingNumber', $trackingNumber)->first();

        if (!$delivery) {

            return response()->json([
                'success' => false,
                'message' => 'Delivery not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $delivery
        ]);
    }

    /**
     * POST /api/deliveries/{id}/deliver
     * Mark a specific package as delivered.
     */
    public function markDelivered($id)
    {
        $delivery = Deliveries::find($id);

        if (!$delivery) {

            return response()->json([
                'success' => false,
                'message' => 'Delivery not found.'
            ], 404);
        }

        if ($delivery->Status == 'Delivered') {

            return response()->json([
                'success' => false,
                'message' => 'Delivery already marked as delivered.'
            ], 400);
        }

        $delivery->Status = 'Delivered';
        $delivery->DeliveredAt = now();
        $delivery->save();

        $this->notifyBuyer($delivery, 'Colis livré', 'Votre colis a été livré avec succès.');

        return response()->json([
            'success' => true,
            'message' => 'Delivery marked as delivered.',
            'data' => $delivery
        ]);
    }

    /**
     * POST /api/deliveries/{id}/status
     * Body: { "Status": "In Transit" }
     * Generic status transition (Pending -> In Transit -> Delivered / Failed).
     */
    public function updateStatus(Request $request, $id)
    {
        $delivery = Deliveries::find($id);

        if (!$delivery) {

            return response()->json([
                'success' => false,
                'message' => 'Delivery not found.'
            ], 404);
        }

        $request->validate([
            'Status' => 'required|string|in:Pending,In Transit,Delivered,Failed,Returned'
        ]);

        $delivery->Status = $request->Status;

        if ($request->Status == 'Delivered') {
            $delivery->DeliveredAt = now();
        }

        $delivery->save();

        $this->notifyBuyer(
            $delivery,
            'Mise à jour de livraison',
            "Le statut de votre colis est maintenant : {$delivery->Status}."
        );

        return response()->json([
            'success' => true,
            'message' => 'Delivery status updated.',
            'data' => $delivery
        ]);
    }

    /**
     * Retrouve l'acheteur (Orders.IdUser) via la livraison -> commande,
     * et lui envoie une notification. Ne fait rien silencieusement si la
     * commande liée n'existe plus (ne doit jamais faire échouer l'appel
     * principal pour un souci de notification).
     */
    private function notifyBuyer(Deliveries $delivery, string $title, string $description): void
    {
        $order = \App\Models\Orders::find($delivery->IdOrder);
        if ($order) {
            $this->notifications->send(
                $order->IdUser,
                $title,
                $description,
                NotificationService::TYPE_DELIVERY_UPDATE
            );
        }
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
