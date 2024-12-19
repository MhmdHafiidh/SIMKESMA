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
                            <th>Nama</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Tanggal Periksa</th>
                            <th>Diagnosis</th>
                            <th>Tindakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamMedis as $rekam)
                            <tr>
                                <td>{{ $rekam->id }}</td>
                                <td>{{ $rekam->mahasiswa->name }}</td>
                                <td>{{ $rekam->keluhan }}</td>
                                <td>{{ $rekam->status }}</td>
                                <td>{{ \Carbon\Carbon::parse($rekam->tanggal_periksa)->format('d/m/Y') }}</td>
                                <td>{{ $rekam->diagnosis ?? 'Belum ada diagnosis' }}</td>
                                <td>{{ $rekam->tindakan ?? 'Belum ada tindakan' }}</td>
                                <td class="d-flex justify-content-start">
                                    <a href="{{ route('rekam_medis.show', $rekam->id) }}" class="btn btn-info btn-sm mr-2">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <form action="{{ route('rekam_medis.destroy', $rekam->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
