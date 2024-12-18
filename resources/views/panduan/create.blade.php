@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Panduan Kesehatan</h1>

        <form action="{{ route('dokter.panduan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea name="konten" id="konten" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('dokter.panduan.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
