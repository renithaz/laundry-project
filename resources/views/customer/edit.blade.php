@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <h5 class="card-title">{{ $title ?? '' }}</h5>
                    <form action="{{ route('customer.update', $customer->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Name *</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                placeholder="Enter your name" required value="{{ $customer->customer_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Phone *</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter your phone" required value="{{ $customer->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address *</label>
                            <input type="textarea" class="form-control" id="address" name="address"
                                placeholder="Enter your address" value="{{ $customer->address }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Change</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
