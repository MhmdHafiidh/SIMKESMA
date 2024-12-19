@extends('layouts.sbadmin2')

@section('content')
    <div class="container">
        <div class="position-relative mb-5 p-4 rounded-lg" style="background: linear-gradient(135deg, #2980b9, #21618c); transform-style: preserve-3d;">
            <h1 class="text-center text-white display-6 mb-0" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
                Edit Panduan Kesehatan
            </h1>
            <div class="position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQ0MCIgaGVpZ2h0PSI1MDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IHgxPSIwJSIgeTE9IjAlIiB4Mj0iMTAwJSIgeTI9IjEwMCUiIGlkPSJhIj48c3RvcCBzdG9wLWNvbG9yPSIjZmZmIiBzdG9wLW9wYWNpdHk9Ii4xIiBvZmZzZXQ9IjAlIi8+PHN0b3Agc3RvcC1jb2xvcj0iI2ZmZiIgc3RvcC1vcGFjaXR5PSIwIiBvZmZzZXQ9IjEwMCUiLz48L2xpbmVhckdyYWRpZW50PjwvZGVmcz48cGF0aCBkPSJNMCAwaDE0NDB2NTAwSDB6IiBmaWxsPSJ1cmwoI2EpIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=') center/cover; opacity: 0.1; pointer-events: none;"></div>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body">
                <form action="{{ route('dokter.panduan.update', $panduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="judul" class="form-label text-primary">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control rounded-3 shadow-sm" value="{{ $panduan->judul }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="konten" class="form-label text-primary">Konten</label>
                        <textarea name="konten" id="konten" class="form-control rounded-3 shadow-sm" rows="5" required>{{ $panduan->konten }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-lg shadow-lg">Simpan</button>
                        <a href="{{ route('dokter.panduan.index') }}" class="btn btn-secondary btn-lg shadow-lg">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
