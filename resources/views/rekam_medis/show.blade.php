@extends('layouts.sbadmin2')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #2980b9;">
            <h6 class="m-0 font-weight-bold text-white">Detail Rekam Medis</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <!-- Add a box (kota) around the content -->
                <div class="border p-4 rounded">
                    <div class="mb-2">
                        <h6><strong>Keluhan:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->keluhan }}</p>
                    </div>
                    <div class="mb-2">
                        <h6><strong>Gejala:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->gejala }}</p>
                    </div>
                    <div class="mb-2">
                        <h6><strong>Riwayat Penyakit:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->riwayat_penyakit ?? 'Tidak ada' }}</p>
                    </div>
                    <div class="mb-2">
                        <h6><strong>Alergi:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->alergi ?? 'Tidak ada' }}</p>
                    </div>
                    <div class="mb-2">
                        <h6><strong>Tekanan Darah:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->tekanan_darah ?? 'Tidak ada' }}</p>
                    </div>
                    <div class="mb-2">
                        <h6><strong>Suhu Badan:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->suhu_badan ?? 'Tidak ada' }}</p>
                    </div>
                    <div class="mb-2">
                        <h6><strong>Tinggi Badan:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->tinggi_badan ?? 'Tidak ada' }}</p>
                    </div>
                    <div class="mb-2">
                        <h6><strong>Berat Badan:</strong></h6>
                        <p class="small text-dark">{{ $rekamMedis->berat_badan ?? 'Tidak ada' }}</p>
                    </div>
                </div>

                @if (auth()->user()->role == 'dokter')
                    <form action="{{ route('rekam_medis.update_diagnosis', $rekamMedis->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="diagnosis"><strong>Diagnosis:</strong></label>
                            <textarea class="form-control" name="diagnosis" id="diagnosis" rows="2" required>{{ $rekamMedis->diagnosis }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tindakan"><strong>Tindakan:</strong></label>
                            <textarea class="form-control" name="tindakan" id="tindakan" rows="2" required>{{ $rekamMedis->tindakan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
