@extends('layouts.sbadmin2')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #2980b9;;">
            <h6 class="m-0 font-weight-bold text-white">Daftar Rekam Medis Saya</h6>
        </div>
        <div class="card-body" style="background-color: #eef2f7;">
            <div class="table-responsive">
                <table class="table" id="dataTable" style="width: 90%; margin: auto; background-color: white; border-collapse: collapse; border-radius: 12px; overflow: hidden; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);">
                    <thead>
                        <tr style="background-color: #2980b9; color: white; text-transform: uppercase;">
                            <th style="padding: 1.2rem;">ID</th>
                            <th style="padding: 1.2rem;">Keluhan</th>
                            <th style="padding: 1.2rem;">Status</th>
                            <th style="padding: 1.2rem;">Tanggal Periksa</th>
                            <th style="padding: 1.2rem;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamMedis as $rekam)
                            <tr style="transition: all 0.2s ease;">
                                <td style="padding: 1.2rem; text-align: center;">{{ $rekam->id }}</td>
                                <td style="padding: 1.2rem; text-align: center;">{{ $rekam->keluhan }}</td>
                                <td style="padding: 1.2rem; text-align: center;">{{ $rekam->status }}</td>
                                <td style="padding: 1.2rem; text-align: center;">{{ $rekam->tanggal_periksa ?? 'Belum diperiksa' }}</td>
                                <td style="padding: 1.2rem; text-align: center;">
                                    <a href="{{ route('rekam_medis.show', $rekam->id) }}" style="color: #0056b3; text-decoration: none; font-weight: bold; padding: 0.5rem 1rem; border: 1px solid #0056b3; border-radius: 8px; transition: all 0.3s ease;">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
