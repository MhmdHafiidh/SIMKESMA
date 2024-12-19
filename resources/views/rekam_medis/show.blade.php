<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rekam Medis</title>
</head>

<body>
    <h1>Detail Rekam Medis</h1>
    <p><strong>Keluhan:</strong> {{ $rekamMedis->keluhan }}</p>
    <p><strong>Gejala:</strong> {{ $rekamMedis->gejala }}</p>
    <p><strong>Riwayat Penyakit:</strong> {{ $rekamMedis->riwayat_penyakit ?? 'Tidak ada' }}</p>
    <p><strong>Alergi:</strong> {{ $rekamMedis->alergi ?? 'Tidak ada' }}</p>
    <p><strong>Tekanan Darah:</strong> {{ $rekamMedis->tekanan_darah ?? 'Tidak ada' }}</p>
    <p><strong>Suhu Badan:</strong> {{ $rekamMedis->suhu_badan ?? 'Tidak ada' }}</p>
    <p><strong>Tinggi Badan:</strong> {{ $rekamMedis->tinggi_badan ?? 'Tidak ada' }}</p>
    <p><strong>Berat Badan:</strong> {{ $rekamMedis->berat_badan ?? 'Tidak ada' }}</p>

    @if (auth()->user()->role == 'dokter')
        <form action="{{ route('rekam_medis.update_diagnosis', $rekamMedis->id) }}" method="POST">
            @csrf
            <label for="diagnosis">Diagnosis:</label>
            <textarea name="diagnosis" id="diagnosis" required>{{ $rekamMedis->diagnosis }}</textarea><br>

            <label for="tindakan">Tindakan:</label>
            <textarea name="tindakan" id="tindakan" required>{{ $rekamMedis->tindakan }}</textarea><br>
            <button type="submit">Simpan</button>
        </form>
    @endif
</body>

</html>
