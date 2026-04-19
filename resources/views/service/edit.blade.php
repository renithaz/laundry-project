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
                    <form action="{{ route('service.update', $service->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Nama Service *</label>
                            <input type="text" class="form-control" id="service_name" name="service_name"
                                placeholder="Masukkan nama service" required value="{{ $service->service_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Harga *</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Masukkan harga" required value="{{ $service->price }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi *</label>
                            <input type="textarea" class="form-control" id="description" name="description"
                                placeholder="Masukkan deskripsi" value="{{ $service->description }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Change</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
