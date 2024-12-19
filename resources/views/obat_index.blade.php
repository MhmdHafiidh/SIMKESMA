@extends('layouts.sbadmin2')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #2980b9;">
            <h6 class="m-0 font-weight-bold text-white">Data Obat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color: #2980b9; color: white;">
                        <tr>
                            <th>id</th>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Satuan</th>
                            <th>Qty</th>
                            <th>Tanggal Expired</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obat as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->kode_obat }}</td>
                                <td>{{ $item->nama_obat }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>
                                    <span
                                        class="badge
                                        {{ $item->qty <= 0 ? 'badge-danger' : 'badge-success' }}">
                                        {{ $item->qty <= 0 ? 'Habis' : 'Tersedia' }}
                                    </span>
                                    <strong>({{ $item->qty }})</strong>
                                </td>
                                <td>
                                    {{ $item->tanggal_expired ? \Carbon\Carbon::parse($item->tanggal_expired)->format('d-m-Y') : 'Tidak ada' }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                    <form action="{{ route('obat.destroy', $item->id) }}" method="POST" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Hapus
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

    {{-- Modal Update --}}
    @foreach ($obat as $item)
        <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2980b9; color: white;">
                        <h5 class="modal-title" id="updateModalLabel">Update Obat - {{ $item->nama_obat }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('obat.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_obat">Kode Obat</label>
                                <input type="text" class="form-control" name="kode_obat" value="{{ $item->kode_obat }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_obat">Nama Obat</label>
                                <input type="text" class="form-control" name="nama_obat" value="{{ $item->nama_obat }}" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select name="satuan" class="form-control">
                                    <option value="botol" {{ $item->satuan == 'botol' ? 'selected' : '' }}>Botol</option>
                                    <option value="tablet" {{ $item->satuan == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                    <option value="kapsul" {{ $item->satuan == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                                    <option value="strip" {{ $item->satuan == 'strip' ? 'selected' : '' }}>Strip</option>
                                    <option value="pcs" {{ $item->satuan == 'pcs' ? 'selected' : '' }}>Pcs</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipe">Tipe</label>
                                <select name="tipe" class="form-control">
                                    <option value="generik" {{ $item->tipe == 'generik' ? 'selected' : '' }}>Generik</option>
                                    <option value="paten" {{ $item->tipe == 'paten' ? 'selected' : '' }}>Paten</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" class="form-control" name="qty" value="{{ $item->qty }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_expired">Tanggal Expired</label>
                                <input type="date" class="form-control" name="tanggal_expired" 
                                    value="{{ $item->tanggal_expired ? \Carbon\Carbon::parse($item->tanggal_expired)->format('Y-m-d') : '' }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Modal Detail --}}
    @foreach ($obat as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2980b9; color: white;">
                        <h5 class="modal-title" id="detailModalLabel">Detail Obat - {{ $item->nama_obat }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Kode Obat:</strong> {{ $item->kode_obat }}</p>
                        <p><strong>Nama Obat:</strong> {{ $item->nama_obat }}</p>
                        <p><strong>Satuan:</strong> {{ $item->satuan }}</p>
                        <p><strong>Qty:</strong> {{ $item->qty }}</p>
                        <p><strong>Tanggal Expired:</strong> 
                            {{ $item->tanggal_expired ? \Carbon\Carbon::parse($item->tanggal_expired)->format('d-m-Y') : 'Tidak ada' }}
                        </p>
                        <p><strong>Tipe:</strong> {{ $item->tipe }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
