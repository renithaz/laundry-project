@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Detail Order
    </div>

    <div class="card-body">

        <p><strong>Kode:</strong> {{ $order->order_code }}</p>
        <p><strong>Customer:</strong> {{ $order->customer?->customer_name ?? $order->customer_name }} <span class="badge {{ $order->customer_id ? 'bg-primary text-white' : 'bg-secondary text-white' }}">{{ $order->customer_id ? 'Member' : 'Bukan Member' }}</span></p>
        @if($order->voucher_code)
        <p><strong>Voucher:</strong> {{ $order->voucher_code }}</p>
        @endif
        @if($order->discount_percent > 0)
        <p><strong>Diskon:</strong> {{ $order->discount_percent }}% (Rp {{ number_format($order->discount_nominal, 0, ',', '.') }})</p>
        @endif
        <p><strong>Tanggal:</strong> {{ $order->order_date }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total,0,',','.') }}</p>

        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>Layanan</th>
                    <th>Catatan</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $d)
                <tr>
                    <td>{{ $d->service->service_name }}</td>
                    <td>{{ $d->notes ?? '-' }}</td>
                    <td>{{ $d->qty }}</td>
                    <td>Rp {{ number_format($d->service->price,0,',','.') }}</td>
                    <td>Rp {{ number_format($d->subtotal,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span>Rp {{ number_format($order->details->sum('subtotal'), 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2 text-success">
                    <span>Diskon ({{ $order->discount_percent }}%):</span>
                    <span>-Rp {{ number_format($order->discount_nominal, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Pajak (10%):</span>
                    <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="fw-bold">Total:</h5>
                    <h5 class="fw-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('transaction.print', $order->id) }}" target="_blank" class="btn btn-warning">Cetak Struk</a>
    </div>
</div>
@endsection