@extends('layouts.sbadmin2')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #2980b9;">
            <h6 class="m-0 font-weight-bold text-white">Form Rekam Medis</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('rekam_medis.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keluhan" class="font-weight-bold">Keluhan</label>
                            <input class="form-control" name="keluhan" id="keluhan" placeholder="Masukkan keluhan pasien"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="gejala" class="font-weight-bold">Gejala</label>
                            <input class="form-control" name="gejala" id="gejala"
                                placeholder="Masukkan gejala yang dialami" required>
                        </div>

                        <div class="form-group">
                            <label for="riwayat_penyakit" class="font-weight-bold">Riwayat Penyakit</label>
                            <input class="form-control" name="riwayat_penyakit" id="riwayat_penyakit"
                                placeholder="Masukkan riwayat penyakit sebelumnya">
                        </div>

                        <div class="form-group">
                            <label for="alergi" class="font-weight-bold">Alergi</label>
                            <input type="text" class="form-control" name="alergi" id="alergi"
                                placeholder="Masukkan alergi (jika ada)">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_periksa" class="font-weight-bold">Tanggal Periksa</label>
                            <input type="date" class="form-control" name="tanggal_periksa" id="tanggal_periksa" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tekanan_darah" class="font-weight-bold">Tekanan Darah</label>
                            <input type="text" class="form-control" name="tekanan_darah" id="tekanan_darah"
                                placeholder="Masukkan tekanan darah">
                        </div>

                        <div class="form-group">
                            <label for="suhu_badan" class="font-weight-bold">Suhu Badan</label>
                            <input type="number" class="form-control" name="suhu_badan" id="suhu_badan" step="0.1"
                                placeholder="Masukkan suhu badan">
                        </div>

                        <div class="form-group">
                            <label for="tinggi_badan" class="font-weight-bold">Tinggi Badan</label>
                            <input type="number" class="form-control" name="tinggi_badan" id="tinggi_badan"
                                placeholder="Masukkan tinggi badan">
                        </div>

                        <div class="form-group">
                            <label for="berat_badan" class="font-weight-bold">Berat Badan</label>
                            <input type="number" class="form-control" name="berat_badan" id="berat_badan" step="0.1"
                                placeholder="Masukkan berat badan">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
