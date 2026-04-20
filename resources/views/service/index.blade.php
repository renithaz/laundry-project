@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">{{ $title ?? '' }}</h5> -->
                    <div class="mb-3" align="right">
                        <a href="{{ route('service.create') }}" class="btn btn-sm btn-primary mt-3">Buat Service Baru</a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Service</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $service->service_name }}</td>
                                    <td>Rp {{ number_format($service->price,0, ',', '.')}}</td>
                                    <td>{{ $service->description }}</td>

                                    <td>
                                        <a href="{{ route('service.edit', $service->id) }}"
                                            class="btn btn-primary btn-sm">Ubah</a>
                                        <form id="delete-form-{{ $service->id }}"
                                            action="{{ route('service.destroy', $service->id) }}" method="post" class="d-inline">
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
