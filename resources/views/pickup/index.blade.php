@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Data Pickup Laundry</h5> -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="mb-3" align="right">
                        <a href="{{ route('pickup.create') }}" class="btn btn-sm btn-primary mt-3">Tambah Pickup</a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Order</th>
                                <th>Nama Customer</th>
                                <th>Tanggal Pickup</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pickups as $pickup)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pickup->order->order_code ?? '-' }}</td>
                                    <td>{{ $pickup->customer->customer_name ?? '-' }}</td>
                                    <td>{{ $pickup->pickup_date }}</td>
                                    <td>{{ $pickup->notes }}</td>
                                    <td>
                                        
                                        <form id="delete-form-{{ $pickup->id }}"
                                            action="{{ route('pickup.destroy', $pickup->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
