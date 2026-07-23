<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f2f2f2;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        .no-border td {
            border: none;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .mt20 {
            margin-top: 20px;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
        }
    </style>

</head>

<body>

    <h1>INVOICE</h1>

    <table class="no-border">

        <tr>

            <td width="50%">

                <h3>Vendor</h3>

                <strong>{{ $invoice->vendor->CompanyName }}</strong><br>

                {{ $invoice->vendor->TradeName }}<br>

                {{ $invoice->vendor->Address }}<br>

                {{ $invoice->vendor->City }}<br>

                {{ $invoice->vendor->Country }}<br>

                Phone :
                {{ $invoice->vendor->Telephone }}<br>

                Email :
                {{ $invoice->vendor->Email }}<br>

                Tax :
                {{ $invoice->vendor->TaxNumber }}

            </td>

            <td width="50%">

                <h3>Customer</h3>

                <strong>

                    {{ $invoice->user->FirstName }}
                    {{ $invoice->user->LastName }}

                </strong>

                <br>

                Email :
                {{ $invoice->user->Email }}

                <br>

                Phone :
                {{ $invoice->user->Telephone }}

            </td>

        </tr>

    </table>

    <br>

    <table class="no-border">

        <tr>

            <td>

                Invoice Number :
                <strong>{{ $invoice->Number }}</strong>

            </td>

            <td>

                Order :
                {{ $invoice->IdOrder }}

            </td>

            <td>

                Status :
                {{ $invoice->Status }}

            </td>

        </tr>

        <tr>

            <td>

                Issue Date :

                {{ $invoice->IssuedAt }}

            </td>

            <td>

                Payment :

                {{ $invoice->PaymentMethod }}

            </td>

            <td>

                Terms :

                {{ $invoice->PaymentTerms }}

            </td>

        </tr>

    </table>

    <div class="mt20"></div>

    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>Product</th>

                <th>Quantity</th>

                <th>Unit Price</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @php

            $index=1;

            @endphp

            @foreach($invoice->order->details as $detail)

            @php
            $unitPrice = !empty($detail->UnitPrice)
            ? $detail->UnitPrice
            : $detail->product->PriceProduct;
            @endphp

            <tr>

                <td class="center">

                    {{ $index++ }}

                </td>

                <td>

                    {{ $detail->product->TitleProduct }}

                </td>

                <td class="center">

                    {{ $detail->Quantity }}

                </td>

                <td class="right">

                    {{ number_format($detail->UnitPrice,3) }}

                </td>

                <td class="right">

                    {{ number_format($detail->Quantity*$detail->UnitPrice,3) }}

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <br>

    <table>

        <tr>
            <td width="80%">Total HT</td>
            <td class="right">{{ number_format($netHT,3) }}</td>
        </tr>

        <tr>
            <td>Discount</td>
            <td class="right">{{ number_format($discount,3) }}</td>
        </tr>

        <tr>
            <td>Fodec 1%</td>
            <td class="right">{{ number_format($fodec,3) }}</td>
        </tr>

        <tr>
            <td>TVA 19%</td>
            <td class="right">{{ number_format($tva,3) }}</td>
        </tr>

        <tr>
            <td>Delivery</td>
            <td class="right">{{ number_format($delivery,3) }}</td>
        </tr>

        <tr>
            <td>Timbre</td>
            <td class="right">{{ number_format($timbre,3) }}</td>
        </tr>

        <tr>
            <td class="total">TOTAL TTC</td>
            <td class="right total">{{ number_format($totalTTC,3) }}</td>
        </tr>

    </table>

    <br><br>

    <table class="no-border">

        <tr>

            <td>

                Customer Signature

            </td>

            <td class="right">

                Vendor Signature

            </td>

        </tr>

    </table>

</body>

</html>
