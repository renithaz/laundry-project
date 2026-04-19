@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Tambah Pickup Laundry</h5> -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('pickup.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label class="form-label">Order</label>
                            <select name="order_id" id="order_id" class="form-control" required>
                                <option value="">-- Pilih Order --</option>
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}" data-customer="{{ $order->customer_id }}">{{ $order->order_code }} - {{ $order->customer->customer_name ?? $order->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer</label>
                            <select name="customer_id" id="customer_id" class="form-control" required>
                                <option value="">-- Pilih Customer --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pickup</label>
                            <input type="datetime-local" class="form-control" name="pickup_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pickup.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('order_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var customerId = selectedOption.getAttribute('data-customer');
            if (customerId) {
                document.getElementById('customer_id').value = customerId;
            }
        });
    </script>
@endsection
