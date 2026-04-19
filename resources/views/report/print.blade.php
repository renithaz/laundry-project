<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h3 { margin: 0; padding: 0; }
        .header p { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h3>LAPORAN PENJUALAN TRANSAKSI LAUNDRY</h3>
        <p>
            Periode: 
            @if($startDate && $endDate)
                {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}
            @else
                Semua Transaksi
            @endif
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Order</th>
                <th>Tanggal Order</th>
                <th>Customer</th>
                <th>Status</th>
                <th class="text-right">Total Belanja</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSemua = 0; @endphp
            @forelse($orders as $key => $order)
                @php $totalSemua += $order->total; @endphp
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                    <td>{{ $order->customer?->customer_name ?? $order->customer_name ?? '-' }}</td>
                    <td>
                        @if($order->order_status == 0)
                            Proses
                        @elseif($order->order_status == 1)
                            Selesai
                        @else
                            Diambil
                        @endif
                    </td>
                    <td class="text-right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total Seluruhnya</th>
                <th class="text-right">Rp {{ number_format($totalSemua, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
