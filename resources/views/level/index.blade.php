@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">{{ $title ?? '' }}</h5> -->
                    <div class="mb-3" align="right">
                        <a href="{{ route('level.create') }}" class="btn btn-sm btn-primary mt-3">Buat Level Baru</a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($levels as $level)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $level->name }}</td>
                                    <td>
                                        <a href="{{ route('level.edit', $level->id) }}" class="btn btn-primary btn-sm">Ubah</a>
                                        <form id="delete-form-{{ $level->id }}" action="{{ route('level.destroy', $level->id) }}" method="post" class="d-inline">
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
