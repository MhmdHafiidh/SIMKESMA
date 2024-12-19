@extends('layouts.sbadmin2')

@section('content')
    <div class="card">
        <div class="card-header">Edit Data Mahasiswa</div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $mahasiswa->nama_lengkap }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}" required>
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ $mahasiswa->tempat_lahir }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prodi">Program Studi</label>
                    <select name="prodi" class="form-control" required>
                        @foreach ($prodi as $p)
                            <option value="{{ $p }}" {{ $mahasiswa->prodi == $p ? 'selected' : '' }}>
                                {{ $p }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <select name="angkatan" class="form-control" required>
                        @foreach ($angkatan as $a)
                            <option value="{{ $a }}" {{ $mahasiswa->angkatan == $a ? 'selected' : '' }}>
                                {{ $a }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
