@extends('layouts.sbadmin2')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #2980b9;">
            <h6 class="m-0 font-weight-bold text-white">Daftar Rekam Medis Saya</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #2980b9; color: white;">
                        <tr>
                            <th>ID</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Tanggal Periksa</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamMedis as $rekam)
                            <tr>
                                <td>{{ $rekam->id }}</td>
                                <td>{{ $rekam->keluhan }}</td>
                                <td>{{ $rekam->status }}</td>
                                <td>{{ $rekam->tanggal_periksa ?? 'Belum diperiksa' }}</td>
                                <td>
                                    <a href="{{ route('rekam_medis.show', $rekam->id) }}" class="btn btn-info btn-sm">
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
