@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Panduan Kesehatan</h1>

        <!-- Tombol Tambah Panduan (Hanya untuk Dokter) -->
        @if (auth()->user()->role == 'dokter')
            <div class="mb-4">
                <a href="{{ route('dokter.panduan.create') }}" class="btn btn-primary">Tambah Panduan</a>
            </div>
        @endif

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('dokter.panduan.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari panduan kesehatan..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <!-- Daftar Panduan -->
        <div class="row">
            @foreach ($panduans as $panduan)
                <div class="col-lg-4 d-flex align-items-stretch mb-4">
                    <div class="icon-box mt-4 mt-xl-0">
                        <i class="bx bx-receipt"></i>
                        <h4>{{ $panduan->judul }}</h4>

                        <!-- Konten singkat -->
                        <p id="shortContent{{ $panduan->id }}">{{ Str::limit($panduan->konten, 100) }}</p>

                        <!-- Link untuk membuka/menutup konten lengkap -->
                        <a href="javascript:void(0)"
                           style="color: #4169E1; text-decoration: none;"
                           data-bs-toggle="collapse"
                           data-bs-target="#collapsePanduan{{ $panduan->id }}"
                           aria-expanded="false"
                           aria-controls="collapsePanduan{{ $panduan->id }}"
                           onclick="toggleContent({{ $panduan->id }})">
                            <span id="toggleText{{ $panduan->id }}">Lihat Selengkapnya</span>
                        </a>

                        <!-- Konten lengkap dengan fitur collapse -->
                        <div class="collapse mt-2" id="collapsePanduan{{ $panduan->id }}">
                            <div class="card card-body">
                                <p>{{ $panduan->konten }}</p>
                            </div>
                        </div>

                        <!-- Jika Role Dokter -->
                        @if (auth()->user()->role == 'dokter')
                            <div class="mt-3">
                                <a href="{{ route('dokter.panduan.edit', $panduan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('dokter.panduan.destroy', $panduan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Jika Tidak Ada Data -->
        @if ($panduans->isEmpty())
            <div class="alert alert-warning mt-4">Panduan tidak ditemukan.</div>
        @endif
    </div>

    <!-- JavaScript -->
    <script>
        function toggleContent(id) {
            const shortContent = document.getElementById('shortContent' + id);
            const toggleText = document.getElementById('toggleText' + id);

            if (shortContent) {
                if (shortContent.style.display === 'none') {
                    shortContent.style.display = 'block';
                    toggleText.textContent = 'Lihat Selengkapnya';
                } else {
                    shortContent.style.display = 'none';
                    toggleText.textContent = 'Tutup';
                }
            }
        }
    </script>
@endsection
