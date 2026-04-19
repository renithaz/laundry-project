@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Laporan Penjualan Transaksi</h5>
    </div>

    <div class="card-body mt-3">
        <form action="{{ route('report.index') }}" method="GET" class="mb-4">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="start_date">Tanggal Awal</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date', $startDate ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date', $endDate ?? '') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('report.index') }}" class="btn btn-secondary">Reset</a>
                    <button type="submit" name="action" value="print" class="btn btn-success" formtarget="_blank"><i class="bi bi-printer"></i> Cetak</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Order</th>
                    <th>Tanggal Order</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total Belanja</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSemua = 0; @endphp
                @forelse($orders as $key => $order)
                    @php $totalSemua += $order->total; @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                        <td>{{ $order->customer?->customer_name ?? $order->customer_name ?? '-' }}</td>
                        <td>
                            @if($order->order_status == 0)
                                <span class="badge bg-warning text-dark">Proses</span>
                            @elseif($order->order_status == 1)
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-info text-dark">Diambil</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-end">Total Seluruhnya</th>
                    <th>Rp {{ number_format($totalSemua, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
@endsection
