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
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $d)
                <tr>
                    <td>{{ $d->service->service_name }}</td>
                    <td>{{ $d->qty }}</td>
                    <td>Rp {{ number_format($d->service->price,0,',','.') }}</td>
                    <td>Rp {{ number_format($d->subtotal,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection