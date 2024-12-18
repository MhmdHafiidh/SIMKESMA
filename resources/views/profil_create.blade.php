@extends('layouts.sbadmin2')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #2980b9, #21618c);">
            <h5 class="m-0">PROFIL SAYA - {{ strtoupper(auth()->user()->name) }}</h5>
        </div>
        <div class="card-body">
            <form action="/profil" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf

                <!-- Nama -->
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Nama</label>
                    <input class="form-control @error('name') is-invalid @enderror"
                           type="text"
                           name="name"
                           value="{{ $user->name }}"
                           placeholder="Masukkan Nama"
                           autofocus>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Username -->
                <div class="form-group mt-3">
                    <label for="username" class="font-weight-bold">Username</label>
                    <input class="form-control @error('username') is-invalid @enderror"
                           type="text"
                           name="username"
                           value="{{ $user->email }}"
                           placeholder="Masukkan Username">
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group mt-3">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror"
                           type="password"
                           name="password"
                           value="{{ old('password') }}"
                           placeholder="Masukkan Password Baru">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-block"
                            style="background: linear-gradient(135deg, #2980b9, #21618c); border: none;">
                        <i class="fas fa-save"></i> UPDATE
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
