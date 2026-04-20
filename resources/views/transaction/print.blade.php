<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi - {{ $transOrder->order_code }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .receipt {
            width: 280px;
            background: #fff;
            margin: 20px auto;
            padding: 15px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }
        .header p {
            margin: 0;
            font-size: 11px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .info {
            margin-bottom: 10px;
        }
        .info table {
            width: 100%;
            font-size: 12px;
        }
        .items table {
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;
        }
        .items th, .items td {
            padding: 3px 0;
        }
        .items th {
            text-align: left;
            border-bottom: 1px dashed #000;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .totals table {
            width: 100%;
            font-size: 12px;
        }
        .totals table td {
            padding: 2px 0;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 11px;
        }
        @media print {
            body { background: transparent; }
            .receipt {
                width: 100%;
                max-width: 280px;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <div class="header">
            <h3>Laundry PPKD</h3>
            <p>Jl. Batu Angin No. 123, Kota Jakarta Timur</p>
            <p>Telp: 081234567890</p>
        </div>
        
        <div class="divider"></div>
        
        <div class="info">
            <table>
                <tr><td>No. Order</td><td>: {{ $transOrder->order_code }}</td></tr>
                <tr><td>Tanggal</td><td>: {{ \Carbon\Carbon::parse($transOrder->created_at)->format('d/m/Y H:i') }}</td></tr>
                <tr><td>Customer</td><td>: {{ $transOrder->customer_id ? ($transOrder->customer->customer_name ?? '-') : ($transOrder->customer_name ?? '-') }}</td></tr>
            </table>
        </div>
        
        <div class="divider"></div>
        
        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transOrder->details as $d)
                    <tr>
                        <td colspan="3">{{ $d->service->service_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Rp {{ number_format($d->service->price ?? 0, 0, ',', '.') }}</td>
                        <td class="text-right">x{{ $d->qty }}</td>
                        <td class="text-right">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="divider"></div>
        
        <div class="totals">
            <table>
                @php
                    $subTotalSum = $transOrder->details->sum('subtotal');
                    $discountAmount = $transOrder->discount_nominal;
                @endphp
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">Rp {{ number_format($subTotalSum, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Pajak (10%)</td>
                    <td class="text-right">Rp {{ number_format($transOrder->tax, 0, ',', '.') }}</td>
                </tr>
                @if($discountAmount > 0)
                <tr>
                    <td>Diskon ({{ $transOrder->discount_percent }}%)</td>
                    <td class="text-right">-Rp {{ number_format($discountAmount, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr style="font-weight: bold; font-size: 14px;">
                    <td>Total</td>
                    <td class="text-right">Rp {{ number_format($transOrder->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunai</td>
                    <td class="text-right">Rp {{ number_format($transOrder->order_pay, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Kembali</td>
                    <td class="text-right">Rp {{ number_format($transOrder->order_change, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        
        <div class="divider"></div>
        
        <div class="footer">
            <p>Terima kasih atas kunjungan Anda!</p>
            <p>Harap bawa struk ini saat pengambilan</p>
        </div>
    </div>
</body>
</html>