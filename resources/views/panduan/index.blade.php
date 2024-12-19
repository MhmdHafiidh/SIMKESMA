@extends('layouts.sbadmin2')

@section('content')
    <div class="container py-5">
        <!-- Header dengan animasi dan efek parallax -->
        <div class="position-relative mb-5 p-4 rounded-lg" style="background: linear-gradient(135deg, #2980b9, #21618c); transform-style: preserve-3d;">
            <h1 class="text-center text-white display-5 mb-0" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
                Daftar Panduan Kesehatan
            </h1>
            <div class="position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQ0MCIgaGVpZ2h0PSI1MDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IHgxPSIwJSIgeTE9IjAlIiB4Mj0iMTAwJSIgeTI9IjEwMCUiIGlkPSJhIj48c3RvcCBzdG9wLWNvbG9yPSIjZmZmIiBzdG9wLW9wYWNpdHk9Ii4xIiBvZmZzZXQ9IjAlIi8+PHN0b3Agc3RvcC1jb2xvcj0iI2ZmZiIgc3RvcC1vcGFjaXR5PSIwIiBvZmZzZXQ9IjEwMCUiLz48L2xpbmVhckdyYWRpZW50PjwvZGVmcz48cGF0aCBkPSJNMCAwaDE0NDB2NTAwSDB6IiBmaWxsPSJ1cmwoI2EpIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=') center/cover; opacity: 0.1; pointer-events: none;"></div>
        </div>

        <!-- Tombol Tambah Panduan dengan hover effect -->
        @if (auth()->user()->role == 'dokter')
            <div class="mb-5 text-center">
                <a href="{{ route('dokter.panduan.create') }}" class="btn btn-primary btn-lg shadow-lg position-relative overflow-hidden" style="transition: all 0.3s ease;">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Panduan
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-white opacity-25" style="transform: translateX(-100%); transition: transform 0.3s ease;"></div>
                </a>
            </div>
        @endif

        <!-- Form Pencarian dengan animasi -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form method="GET" action="{{ route('dokter.panduan.index') }}">
                    <div class="input-group input-group-lg shadow-lg rounded-pill overflow-hidden">
                        <input type="text" name="search" class="form-control border-0 ps-4"
                               placeholder="Cari panduan kesehatan..."
                               value="{{ request('search') }}"
                               style="transition: all 0.3s ease;">
                        <button class="btn btn-primary px-4" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Grid Panduan dengan card yang lebih menarik -->
        <div class="row g-4">
            @foreach ($panduans as $panduan)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 rounded-3 shadow-sm hover-card"
                         style="transition: all 0.2s ease;">
                        <div class="card-body p-4">
                            <!-- Judul dengan line accent -->
                            <h4 class="card-title mb-3 pb-2 position-relative text-dark"
                                style="border-bottom: 2px solid #2980b9;">
                                {{ $panduan->judul }}
                            </h4>

                            <!-- Konten dengan desain minimalis -->
                            <div class="content-wrapper">
                                <p id="shortContent{{ $panduan->id }}" class="text-secondary">
                                    {{ Str::limit($panduan->konten, 100) }}
                                </p>

                                <!-- Toggle yang lebih subtle -->
                                <div class="text-center">
                                    <button class="btn btn-link text-primary px-0 text-decoration-none"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapsePanduan{{ $panduan->id }}"
                                            onclick="toggleContent({{ $panduan->id }})">
                                        <small id="toggleText{{ $panduan->id }}">Baca selengkapnya</small>
                                        <i class="fas fa-angle-down ms-1 toggle-icon"
                                           style="transition: transform 0.2s ease;"></i>
                                    </button>
                                </div>

                                <!-- Konten lengkap dengan background subtle -->
                                <div class="collapse" id="collapsePanduan{{ $panduan->id }}">
                                    <div class="pt-3 text-secondary">
                                        {{ $panduan->konten }}
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->role == 'dokter')
                                <!-- Action buttons yang lebih subtle -->
                                <div class="mt-3 pt-3" style="border-top: 1px solid #eee;">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('dokter.panduan.edit', $panduan->id) }}"
                                           class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('dokter.panduan.destroy', $panduan->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus panduan ini?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pesan tidak ada data yang lebih menarik -->
        @if ($panduans->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">Panduan tidak ditemukan</h3>
                <p class="text-muted">Silakan coba dengan kata kunci pencarian yang berbeda</p>
            </div>
        @endif
    </div>

    <!-- JavaScript yang ditingkatkan -->
    <script>
        function toggleContent(id) {
    const icon = document.querySelector(`#collapsePanduan${id}`).previousElementSibling.querySelector('.toggle-icon');
    const toggleText = document.getElementById(`toggleText${id}`);

    if (icon.classList.contains('rotated')) {
        icon.classList.remove('rotated');
        toggleText.textContent = 'Baca selengkapnya';
    } else {
        icon.classList.add('rotated');
        toggleText.textContent = 'Tutup';
    }
}

        // Animasi hover untuk cards
        document.querySelectorAll('.hover-shadow-lg').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>

    <!-- Tambahan CSS -->
    <style>
        .hover-shadow-lg {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-shadow-lg:hover {
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
        }
        .btn-primary {
            position: relative;
            overflow: hidden;
        }
        .btn-primary:hover::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.2);
            animation: shine 1s;

            .hover-card {
    background: #ffffff;
}

.hover-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}

.btn-link:hover {
    color: #2980b9 !important;
}

.btn-link:focus {
    box-shadow: none;
}

.toggle-icon.rotated {
    transform: rotate(180deg);
}

/* Override Bootstrap button styles for a more subtle look */
.btn-outline-secondary,
.btn-outline-danger {
    border-width: 1px;
    padding: 0.25rem 0.5rem;
}

.btn-outline-secondary:hover,
.btn-outline-danger:hover {
    background-color: #f8f9fa;
    color: currentColor;
    border-color: currentColor;
}
        }
        @keyframes shine {
            to {
                left: 100%;
            }
        }
    </style>
@endsection
