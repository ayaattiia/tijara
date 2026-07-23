<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\Users;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicesController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoices::with([
            'user',
            'vendor',
            'order'
        ]);

        /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('Number', 'LIKE', "%{$search}%")
                    ->orWhere('PaymentMethod', 'LIKE', "%{$search}%")
                    ->orWhere('PaymentTerms', 'LIKE', "%{$search}%")
                    ->orWhere('Status', 'LIKE', "%{$search}%");
            });
        }

        /*
    |--------------------------------------------------------------------------
    | Customer
    |--------------------------------------------------------------------------
    */

        if ($request->filled('IdUser')) {
            $query->where('IdUser', $request->IdUser);
        }

        /*
    |--------------------------------------------------------------------------
    | Vendor
    |--------------------------------------------------------------------------
    */

        if ($request->filled('IdVendor')) {
            $query->where('IdVendor', $request->IdVendor);
        }

        /*
    |--------------------------------------------------------------------------
    | Order
    |--------------------------------------------------------------------------
    */

        if ($request->filled('IdOrder')) {
            $query->where('IdOrder', $request->IdOrder);
        }

        /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

        if ($request->filled('Status')) {
            $query->where('Status', $request->Status);
        }

        /*
    |--------------------------------------------------------------------------
    | Date From
    |--------------------------------------------------------------------------
    */

        if ($request->filled('from')) {
            $query->whereDate(
                'IssuedAt',
                '>=',
                $request->from
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Date To
    |--------------------------------------------------------------------------
    */

        if ($request->filled('to')) {
            $query->whereDate(
                'IssuedAt',
                '<=',
                $request->to
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Total Min
    |--------------------------------------------------------------------------
    */

        if ($request->filled('min')) {
            $query->where(
                'Total',
                '>=',
                $request->min
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Total Max
    |--------------------------------------------------------------------------
    */

        if ($request->filled('max')) {
            $query->where(
                'Total',
                '<=',
                $request->max
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Sorting
    |--------------------------------------------------------------------------
    */

        $sort = $request->get('sort', 'IdInvoice');

        $direction = $request->get('direction', 'desc');

        $allowed = [
            'IdInvoice',
            'Number',
            'Subtotal',
            'Tax',
            'Total',
            'IssuedAt',
            'Status'
        ];

        if (!in_array($sort, $allowed)) {
            $sort = 'IdInvoice';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $query->orderBy($sort, $direction);

        return response()->json([
            'success' => true,
            'count' => $query->count(),
            'data' => $query->get()
        ]);
    }


    public function customerInvoices($userId)
    {
        $invoices = Invoices::with([
            'order'
        ])
            ->where(
                'IdUser',
                $userId
            )
            ->orderByDesc('IssuedAt')
            ->get();

        return response()->json($invoices);
    }

    public function vendorInvoices($vendorId)
    {
        return response()->json(

            Invoices::with([
                'user',
                'order'
            ])
                ->where(
                    'IdVendor',
                    $vendorId
                )
                ->orderByDesc('IssuedAt')
                ->get()

        );
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'IdOrder' => 'required|exists:Orders,IdOrder',

            'PaymentMethod' => 'required|string|max:100',

            'PaymentTerms' => 'nullable|string|max:255',

            'Discount' => 'nullable|numeric|min:0',

            'DiscountType' => 'nullable|in:Amount,Percentage'

        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $order = Orders::with([
                'details.product',
                'user'
            ])->findOrFail($request->IdOrder);

            if ($order->invoice) {

                return response()->json([
                    'success' => false,
                    'message' => 'Invoice already exists.'
                ], 409);
            }

            if ($order->details->count() == 0) {

                return response()->json([
                    'success' => false,
                    'message' => 'Order contains no products.'
                ], 400);
            }

            $customer = $order->user;

            $vendor = Vendor::first();

            if (!$vendor) {

                return response()->json([
                    'success' => false,
                    'message' => 'Vendor not found.'
                ], 404);
            }

            $subtotal = 0;

            foreach ($order->details as $detail) {

                if (!empty($detail->UnitPrice)) {

                    $price = $detail->UnitPrice;
                } else {

                    $price = $detail->product->PriceProduct;
                }

                $subtotal += $price * $detail->Quantity;
            }

            $discount = $request->Discount ?? 0;

            $discountType = $request->DiscountType ?? 'Amount';

            if ($discountType == "Percentage") {

                $discountAmount =
                    ($subtotal * $discount) / 100;
            } else {

                $discountAmount = $discount;
            }

            $afterDiscount =
                max(0, $subtotal - $discountAmount);

            $tvaRate = 19;

            $tax =
                ($afterDiscount * $tvaRate) / 100;

            $delivery = 0;

            if (isset($order->deal)) {

                $delivery =
                    $order->deal->DeliveryFee ?? 0;
            }

            $stamp = 1;

            $total =
                $afterDiscount +
                $tax +
                $delivery +
                $stamp;

            $invoice = Invoices::create([

                'Number' => $this->generateInvoiceNumber(),

                'IdOrder' => $order->IdOrder,

                'IdUser' => $customer->IdUser,

                'IdVendor' => $vendor->IdVendor,

                'Subtotal' => $subtotal,

                'Discount' => $discountAmount,

                'DiscountType' => $discountType,

                'Tax' => $tax,

                'DeliveryFee' => $delivery,

                'Total' => $total,

                'PaymentMethod' => $request->PaymentMethod,

                'PaymentTerms' => $request->PaymentTerms,

                'Status' => 'Pending',

                'IssuedAt' => now()

            ]);

            DB::commit();

            return response()->json([

                'success' => true,

                'message' => 'Invoice generated successfully.',

                'data' => $invoice->load([
                    'order',
                    'user',
                    'vendor'
                ])

            ], 201);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }
    public function show($id)
    {
        $invoice = Invoices::with([
            'user',
            'vendor',
            'order.details.product'
        ])->find($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $invoice
        ]);
    }

    public function showByNumber($number)
    {
        $invoice = Invoices::with([
            'user',
            'vendor',
            'order.details.product'
        ])
            ->where('Number', $number)
            ->first();

        if (!$invoice) {

            return response()->json([
                'success' => false,
                'message' => 'Invoice not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $invoice
        ]);
    }

    public function pay(Request $request, $number)
    {
        $invoice = Invoices::where(
            'Number',
            $number
        )->first();

        if (!$invoice) {

            return response()->json([
                'success' => false,
                'message' => 'Invoice not found.'
            ], 404);
        }

        if ($invoice->Status == "Paid") {

            return response()->json([
                'success' => false,
                'message' => 'Invoice already paid.'
            ], 400);
        }

        $invoice->Status = "Paid";

        $invoice->PaidAt = now();

        $invoice->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment registered successfully.',
            'data' => $invoice
        ]);
    }

    public function cancel($number)
    {
        $invoice = Invoices::where(
            'Number',
            $number
        )->first();

        if (!$invoice) {

            return response()->json([
                'success' => false,
                'message' => 'Invoice not found.'
            ], 404);
        }

        if ($invoice->Status == "Paid") {

            return response()->json([
                'success' => false,
                'message' => 'Paid invoices cannot be cancelled.'
            ], 400);
        }

        $invoice->Status = "Cancelled";

        $invoice->save();

        return response()->json([
            'success' => true,
            'message' => 'Invoice cancelled successfully.',
            'data' => $invoice
        ]);
    }
    public function update(Request $request, $invoices)
    {
        $item = Invoices::findOrFail($invoices);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $invoice = Invoices::find($id);

        if (!$invoice) {

            return response()->json([
                'success' => false,
                'message' => 'Invoice not found.'
            ], 404);
        }

        if ($invoice->Status == "Paid") {

            return response()->json([
                'success' => false,
                'message' => 'Paid invoices cannot be deleted.'
            ], 400);
        }

        $invoice->delete();

        return response()->json([
            'success' => true,
            'message' => 'Invoice deleted successfully.'
        ]);
    }

    private function generateInvoiceNumber(): string
    {
        $year = date('Y');

        $last = Invoices::whereYear('IssuedAt', $year)
            ->orderByDesc('IdInvoice')
            ->first();

        $next = 1;

        if ($last) {
            $parts = explode('-', $last->Number);

            if (count($parts) === 3) {
                $next = ((int)$parts[2]) + 1;
            }
        }

        return sprintf(
            'INV-%s-%06d',
            $year,
            $next
        );
    }

    public function downloadPDF($id)
    {
        $invoice = Invoices::with([
            'vendor',
            'user',
            'order.details.product'
        ])->findOrFail($id);

        $subtotal = 0;
        $discount = 0;

        foreach ($invoice->order->details as $detail) {
            $price = !empty($detail->UnitPrice)
                ? $detail->UnitPrice
                : $detail->product->PriceProduct;

            $subtotal += $detail->UnitPrice * $detail->Quantity;

            $discount += $detail->Discount ?? 0;
        }

        $netHT = $subtotal - $discount;

        $fodec = round($netHT * 0.01, 3);

        $tva = round(($netHT + $fodec) * 0.19, 3);

        $delivery = $invoice->DeliveryFee;

        $timbre = 1.000;

        $totalTTC = round(
            $netHT +
                $fodec +
                $tva +
                $delivery +
                $timbre,
            3
        );

        return PDF::loadView('pdf.invoice', [

            'invoice' => $invoice,

            'subtotal' => $subtotal,

            'discount' => $discount,

            'netHT' => $netHT,

            'fodec' => $fodec,

            'tva' => $tva,

            'delivery' => $delivery,

            'timbre' => $timbre,

            'totalTTC' => $totalTTC

        ])->download($invoice->Number . '.pdf');
    }
}
