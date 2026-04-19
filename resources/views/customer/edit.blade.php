@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <!-- <h5 class="card-title">{{ $title ?? '' }}</h5> -->
                    <form action="{{ route('customer.update', $customer->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Nama Customer *</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                placeholder="Masukkan nama anda" required value="{{ $customer->customer_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">No. Telp *</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Masukkan no.telpon anda" required value="{{ $customer->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat *</label>
                            <input type="textarea" class="form-control" id="address" name="address"
                                placeholder="Masukkan alamat anda" value="{{ $customer->address }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
