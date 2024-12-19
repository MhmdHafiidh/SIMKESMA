@extends('layouts.sbadmin2')

@section('content')
    <div class="card">
        <div class="card-header">Data Mahasiswa</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>Tempat Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahas_table_v2 as $mahasiswa)
                            <tr>
                                <td>{{ $mahasiswa->id }}</td>
                                <td>{{ $mahasiswa->nama_lengkap }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->email }}</td>
                                <td>{{ $mahasiswa->tempat_lahir }}</td>
                                <td>{{ $mahasiswa->jenis_kelamin }}</td>
                                <td>{{ $mahasiswa->prodi }}</td>
                                <td>{{ $mahasiswa->angkatan }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 10px;">
                                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const forms = document.querySelectorAll('form[onsubmit]');
                                forms.forEach(form => {
                                    form.addEventListener('submit', function(e) {
                                        const confirmed = confirm('Apakah Anda yakin ingin menghapus data ini?');
                                        if (!confirmed) {
                                            e.preventDefault(); // Jika pengguna membatalkan, hentikan pengiriman form
                                        }
                                    });
                                });
                            });
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
