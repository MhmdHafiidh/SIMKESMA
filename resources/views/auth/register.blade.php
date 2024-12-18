@extends('layouts.app')

@section('title', 'Registrasi Mahasiswa')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrasi Mahasiswa</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('mahasiswa.store') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label>Nama Lengkap*</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>NIM*</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                                    value="{{ old('nim') }}" required>
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Email*</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Password*</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Konfirmasi Password*</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        value="{{ old('tempat_lahir') }}">
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir') }}">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Program Studi*</label>
                                <select name="prodi" class="form-control @error('prodi') is-invalid @enderror" required>
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p }}" {{ old('prodi') == $p ? 'selected' : '' }}>
                                            {{ $p }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prodi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Angkatan*</label>
                                <select name="angkatan" id="angkatan"
                                    class="form-control @error('angkatan') is-invalid @enderror" required>
                                    <option value="">Pilih Angkatan</option>
                                    @foreach ($angkatan as $tahun)
                                        <option value="{{ $tahun }}"
                                            {{ old('angkatan') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endforeach
                                    <option value="manual" {{ old('angkatan') == 'manual' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>

                                <input type="text" name="angkatan_manual" id="angkatan_manual"
                                    class="form-control mt-2 @error('angkatan_manual') is-invalid @enderror"
                                    placeholder="Masukkan Tahun" style="display: none;"
                                    value="{{ old('angkatan_manual') }}">

                                @error('angkatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('angkatan_manual')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <script>
                                // Menambahkan event listener untuk memilih "Lainnya (Isi Manual)"
                                document.getElementById('angkatan').addEventListener('change', function() {
                                    var angkatanSelect = this.value;
                                    var angkatanManualInput = document.getElementById('angkatan_manual');

                                    if (angkatanSelect == 'manual') {
                                        angkatanManualInput.style.display = 'block'; // Menampilkan input manual
                                    } else {
                                        angkatanManualInput.style.display = 'none'; // Menyembunyikan input manual
                                        angkatanManualInput.value = ''; // Mengosongkan input manual jika tidak dipilih
                                    }
                                });
                            </script>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Daftar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
