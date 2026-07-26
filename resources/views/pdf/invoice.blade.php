<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans;
            font-size: 11px;
            color: #2d2d2d;
            margin: 0;
            padding: 30px 40px;
        }

        /* ---------- Header ---------- */

        .header {
            display: table;
            width: 100%;
            border-bottom: 3px solid #1f3a5f;
            padding-bottom: 14px;
            margin-bottom: 24px;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
        }

        .header-left h1 {
            font-size: 26px;
            letter-spacing: 2px;
            color: #1f3a5f;
            margin: 0;
        }

        .header-left .sub {
            font-size: 10px;
            color: #888;
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }

        .header-right .inv-number {
            font-size: 15px;
            font-weight: bold;
            color: #1f3a5f;
        }

        .header-right .inv-date {
            font-size: 10px;
            color: #888;
            margin-top: 3px;
        }

        .status-badge {
            display: inline-block;
            margin-top: 6px;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #fff;
            background: #6b7280;
        }

        .status-paid {
            background: #1e8e5a;
        }

        .status-issued {
            background: #1f6fb2;
        }

        .status-pending {
            background: #b8860b;
        }

        .status-cancelled {
            background: #b3261e;
        }

        /* ---------- Parties ---------- */

        .parties {
            display: table;
            width: 100%;
            margin-bottom: 22px;
        }

        .party {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 14px 16px;
            background: #f7f8fa;
            border-left: 3px solid #1f3a5f;
        }

        .party+.party {
            margin-left: 12px;
        }

        .party-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 6px;
        }

        .party-name {
            font-size: 13px;
            font-weight: bold;
            color: #1f3a5f;
            margin-bottom: 4px;
        }

        .party-line {
            font-size: 10.5px;
            color: #444;
            line-height: 1.5;
        }

        .party-line .label {
            color: #999;
        }

        /* ---------- Meta strip ---------- */

        .meta {
            display: table;
            width: 100%;
            margin-bottom: 18px;
            font-size: 10.5px;
        }

        .meta-item {
            display: table-cell;
            padding: 8px 10px;
            border: 1px solid #e2e4e8;
        }

        .meta-item .label {
            display: block;
            font-size: 8.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #999;
            margin-bottom: 3px;
        }

        /* ---------- Product table ---------- */

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.items thead th {
            background: #1f3a5f;
            color: #fff;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 9px 8px;
            border: 1px solid #1f3a5f;
        }

        table.items tbody td {
            padding: 8px;
            border: 1px solid #e2e4e8;
            font-size: 10.5px;
        }

        table.items tbody tr:nth-child(even) {
            background: #f7f8fa;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        /* ---------- Totals ---------- */

        .totals-wrap {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .totals-spacer {
            display: table-cell;
            width: 55%;
        }

        .totals-box {
            display: table-cell;
            width: 45%;
            vertical-align: top;
        }

        table.totals {
            width: 100%;
            border-collapse: collapse;
        }

        table.totals td {
            padding: 7px 10px;
            font-size: 10.5px;
            border-bottom: 1px solid #eee;
        }

        table.totals td.label {
            color: #666;
        }

        table.totals tr.total-row td {
            border-bottom: none;
            border-top: 2px solid #1f3a5f;
            font-weight: bold;
            font-size: 13px;
            color: #1f3a5f;
            padding-top: 10px;
        }

        /* ---------- Signatures ---------- */

        .signatures {
            display: table;
            width: 100%;
            margin-top: 50px;
        }

        .sig {
            display: table-cell;
            width: 50%;
            text-align: center;
        }

        .sig .line {
            margin: 0 40px 6px 40px;
            border-top: 1px solid #999;
        }

        .sig .label {
            font-size: 9.5px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-note {
            margin-top: 40px;
            text-align: center;
            font-size: 9px;
            color: #aaa;
        }
    </style>

</head>

<body>

    <div class="header">
        <div class="header-left">
            <h1>INVOICE</h1>
            <div class="sub">{{ $invoice->vendor->CompanyName ?? 'Tijara' }}</div>
        </div>
        <div class="header-right">
            <div class="inv-number">{{ $invoice->Number }}</div>
            <div class="inv-date">{{ \Carbon\Carbon::parse($invoice->IssuedAt)->format('d M Y') }}</div>
            @php
            $statusClass = 'status-badge status-' . strtolower($invoice->Status);
            @endphp
            <div class="{{ $statusClass }}">{{ $invoice->Status }}</div>
        </div>
    </div>

    <div class="parties">

        <div class="party">
            <div class="party-label">Vendor</div>
            <div class="party-name">{{ $invoice->vendor->CompanyName }}</div>
            <div class="party-line">
                {{ $invoice->vendor->FirstName }} {{ $invoice->vendor->LastName }}
            </div>
            <div class="party-line">{{ $invoice->vendor->TradeName }}</div>
            <div class="party-line">
                {{ $invoice->vendor->Address }}
                @if($invoice->vendor->City) , {{ $invoice->vendor->City }} @endif
                @if($invoice->vendor->Country) , {{ $invoice->vendor->Country }} @endif
            </div>
            <div class="party-line"><span class="label">Phone:</span> {{ $invoice->vendor->Telephone }}</div>
            <div class="party-line"><span class="label">Email:</span> {{ $invoice->vendor->Email }}</div>
            <div class="party-line"><span class="label">Tax ID:</span> {{ $invoice->vendor->TaxNumber }}</div>
        </div>

        <div class="party">
            <div class="party-label">Bill To</div>
            <div class="party-name">
                {{ $invoice->user->FirstName }} {{ $invoice->user->LastName }}
            </div>
            <div class="party-line"><span class="label">Email:</span> {{ $invoice->user->Email }}</div>
            <div class="party-line"><span class="label">Phone:</span> {{ $invoice->user->Telephone }}</div>
        </div>

    </div>

    <div class="meta">
        <div class="meta-item">
            <span class="label">Order Reference</span>
            #{{ $invoice->IdOrder }}
        </div>
        <div class="meta-item">
            <span class="label">Payment Method</span>
            {{ $paymentMethod }}
        </div>
    </div>

    <table class="items">

        <thead>
            <tr>
                <th style="width: 6%">#</th>
                <th style="width: 44%">Product</th>
                <th style="width: 15%" class="center">Qty</th>
                <th style="width: 17%" class="right">Unit Price</th>
                <th style="width: 18%" class="right">Total</th>
            </tr>
        </thead>

        <tbody>

            @php $index = 1; @endphp

            @foreach($invoice->order->details as $detail)

            @php
            $unitPrice = !empty($detail->UnitPrice)
            ? $detail->UnitPrice
            : $detail->product->PriceProduct;
            @endphp

            <tr>
                <td class="center">{{ $index++ }}</td>
                <td>{{ $detail->product->TitleProduct }}</td>
                <td class="center">{{ $detail->Quantity }}</td>
                <td class="right">{{ number_format($unitPrice, 3) }} </td>
                <td class="right">{{ number_format($unitPrice * $detail->Quantity, 3) }} </td>
            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="totals-wrap">
        <div class="totals-spacer"></div>
        <div class="totals-box">
            <table class="totals">

                <tr>
                    <td class="label">Total HT</td>
                    <td class="right">{{ number_format($netHT, 3) }}</td>
                </tr>

                <tr>
                    <td class="label">Discount</td>
                    <td class="right">{{ number_format($discount, 3) }}</td>
                </tr>

                <tr>
                    <td class="label">Fodec 1%</td>
                    <td class="right">{{ number_format($fodec, 3) }}</td>
                </tr>

                <tr>
                    <td class="label">TVA 19%</td>
                    <td class="right">{{ number_format($tva, 3) }}</td>
                </tr>

                <tr>
                    <td class="label">Delivery</td>
                    <td class="right">{{ number_format($delivery, 3) }}</td>
                </tr>

                <tr>
                    <td class="label">Timbre</td>
                    <td class="right">{{ number_format($timbre, 3) }}</td>
                </tr>

                <tr class="total-row">
                    <td>Total TTC</td>
                    <td class="right">{{ number_format($totalTTC, 3) }}DT</td>
                </tr>

            </table>
        </div>
    </div>

    <div class="signatures">
        <div class="sig">
            <div class="line"></div>
            <div class="label">Customer Signature</div>
        </div>
        <div class="sig">
            <div class="line"></div>
            <div class="label">Vendor Signature</div>
        </div>
    </div>

    <div class="footer-note">
        Thank you for your business — {{ $invoice->vendor->CompanyName }}
    </div>

</body>

</html>
