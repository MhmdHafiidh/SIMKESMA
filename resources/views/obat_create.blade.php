@extends('layouts.sbadmin2')

@section('content')
    <div class="card shadow-lg rounded">
        <div class="card-header" style="background: linear-gradient(90deg, #2980b9, #41729f); color: white; text-align: center;">
            <h4 class="mb-0">Tambah Obat</h4>
        </div>
        <div class="card-body">
            <form action="/obat" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        {{-- Kode Obat --}}
                        <div class="form-group mt-1">
                            <label for="kode_obat">Kode Obat</label>
                            <input class="form-control rounded-pill" type="text" name="kode_obat" placeholder="Masukkan kode obat"
                                value="{{ old('kode_obat') }}" autofocus>
                            <small class="text-danger">{{ $errors->first('kode_obat') }}</small>
                        </div>

                        {{-- Nama Obat --}}
                        <div class="form-group mt-3">
                            <label for="nama_obat">Nama Obat</label>
                            <input class="form-control rounded-pill" type="text" name="nama_obat" placeholder="Masukkan nama obat"
                                value="{{ old('nama_obat') }}">
                            <small class="text-danger">{{ $errors->first('nama_obat') }}</small>
                        </div>

                        {{-- Satuan --}}
                        <div class="form-group mt-3">
                            <label for="satuan">Satuan</label>
                            <select name="satuan" class="form-control rounded-pill">
                                <option value="" disabled hidden selected>Pilih Satuan</option>
                                <option value="botol" {{ old('satuan') === 'botol' ? 'selected' : '' }}>Botol</option>
                                <option value="tablet" {{ old('satuan') === 'tablet' ? 'selected' : '' }}>Tablet</option>
                                <option value="kapsul" {{ old('satuan') === 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                                <option value="strip" {{ old('satuan') === 'strip' ? 'selected' : '' }}>Strip</option>
                                <option value="pcs" {{ old('satuan') === 'pcs' ? 'selected' : '' }}>Pcs</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('satuan') }}</small>
                        </div>

                        {{-- Tipe --}}
                        <div class="form-group mt-3">
                            <label for="tipe">Tipe</label>
                            <select name="tipe" class="form-control rounded-pill">
                                <option value="" disabled hidden selected>Pilih Tipe</option>
                                <option value="generik" {{ old('tipe') === 'generik' ? 'selected' : '' }}>Generik</option>
                                <option value="paten" {{ old('tipe') === 'paten' ? 'selected' : '' }}>Paten</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('tipe') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- QTY --}}
                        <div class="form-group mt-1">
                            <label for="qty">QTY</label>
                            <input class="form-control rounded-pill" type="number" name="qty" placeholder="Jumlah stok obat"
                                value="{{ old('qty') }}">
                            <small class="text-danger">{{ $errors->first('qty') }}</small>
                        </div>

                        {{-- Tanggal Expired --}}
                        <div class="form-group mt-3">
                            <label for="tanggal_expired">Tanggal Expired</label>
                            <input class="form-control rounded-pill" type="date" name="tanggal_expired"
                                value="{{ date('Y-m-d') }}">
                            <small class="text-danger">{{ $errors->first('tanggal_expired') }}</small>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-lg rounded-pill px-5 shadow" style="background-color: #2980b9; color: white; border: none;">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Custom Styling --}}
@push('styles')
    <style>
        .card {
            border: none;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            border-color: #80bdff;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        label {
            font-weight: 500;
        }
    </style>
@endpush
