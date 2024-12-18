@extends('layouts.app')

@section('title', 'Registrasi Mahasiswa')

@section('content')
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?education,university') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: #2980b9;
            /* Warna biru seperti login */
            color: #fff;
            font-size: 1.2rem;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }

        .btn-primary {
            background-color: #2980b9;
            /* Warna tombol sesuai login */
            border: none;
            transition: transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: scale(1.03);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 120px;
            max-height: 50px;
            margin: 0 15px;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Registrasi Mahasiswa
                    </div>

                    <div class="card-body p-4">
                        {{-- Logo --}}
                        <div class="logo-container">
                            <img src="{{ asset('medilab/assets/img/logo_simkesma.png') }}" alt="Logo 1">
                            <img src="{{ asset('medilab/assets/img/logoo.png') }}" alt="Logo 2">
                        </div>

                        {{-- Alert Messages --}}
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        {{-- Form Start --}}
                        <form method="POST" action="{{ route('mahasiswa.store') }}">
                            @csrf

                            {{-- Nama Lengkap --}}
                            <div class="form-group mb-4">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap"
                                    value="{{ old('nama_lengkap') }}" required>
                            </div>

                            {{-- NIM --}}
                            <div class="form-group mb-4">
                                <label>NIM</label>
                                <input type="text" class="form-control" name="nim" value="{{ old('nim') }}"
                                    required>
                            </div>

                            {{-- Email --}}
                            <div class="form-group mb-4">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required>
                            </div>

                            {{-- Password --}}
                            <div class="form-group mb-4">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="form-group mb-4">
                                <label>Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            {{-- Program Studi --}}
                            <div class="form-group mb-4">
                                <label>Program Studi</label>
                                <select name="prodi" class="form-control" required>
                                    <option value="">Pilih Program Studi</option>
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p }}" {{ old('prodi') == $p ? 'selected' : '' }}>
                                            {{ $p }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Angkatan*</label>
                                <select name="angkatan" id="angkatan"
                                    class="form-control @error('angkatan') is-invalid @enderror" required>
                                    <option value="">Pilih Angkatan</option>
                                    @foreach ($angkatan as $tahun)
                                        <option value="{{ $tahun }}"
                                            {{ old('angkatan') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
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
