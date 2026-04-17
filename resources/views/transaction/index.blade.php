@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Data Transaksi Order</h5>
        <a href="{{ route('transaction.create') }}" class="btn btn-primary">+ Add Order</a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Code Order</th>
                    <th>Customer</th>
                    <th>Order Date</th>
                    <th>Order End Date</th>

                    <th>Status</th>
                    <th>Total</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $key => $order)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->customer?->customer_name ?? $order->customer_name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_end_date)->format('d-m-Y')}}</td>


                        <!-- STATUS -->
                        <td>
                            <form action="{{ route('transaction.update', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <select name="order_status" onchange="this.form.submit()" class="form-select form-select-sm w-auto {{ $order->order_status == 0 ? 'bg-warning text-dark' : ($order->order_status == 1 ? 'bg-success text-white' : 'bg-info text-dark') }}">
                                    <option value="0" {{ $order->order_status == 0 ? 'selected' : '' }} class="bg-white text-dark">Proses</option>
                                    <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }} class="bg-white text-dark">Selesai</option>
                                    <option value="2" {{ $order->order_status == 2 ? 'selected' : '' }} class="bg-white text-dark">Diambil</option>
                                </select>
                            </form>
                        </td>

                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>

                        <td>
                            <a href="{{ route('transaction.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>

                            {{-- <a href="{{ route('transaction.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}

                            <form action="{{ route('transaction.destroy', $order->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>
@endsection