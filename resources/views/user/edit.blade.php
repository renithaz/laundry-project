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
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Level *</label>
                            <select name="level_id" id="" class="form-control">
                                <option value="">--Pilih Level--</option>
                                @foreach ($levels as $level)       
                                <option value="{{ $level->id }}" {{ $level->id == $user->level_id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama *</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan nama anda" required value="{{ $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan email anda" required value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi *</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan kata sandi anda">
                            <small class="text-secondary">Kosongkan kolom ini jika tidak ingin mengubah kata sandi.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
