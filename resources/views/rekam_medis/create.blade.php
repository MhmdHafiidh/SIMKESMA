<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Rekam Medis</title>
</head>

<body>
    <h1>Form Rekam Medis</h1>
    <form action="{{ route('rekam_medis.store') }}" method="POST">
        @csrf
        <label for="keluhan">Keluhan:</label>
        <textarea name="keluhan" id="keluhan" required></textarea><br>

        <label for="gejala">Gejala:</label>
        <textarea name="gejala" id="gejala" required></textarea><br>

        <label for="riwayat_penyakit">Riwayat Penyakit:</label>
        <textarea name="riwayat_penyakit" id="riwayat_penyakit"></textarea><br>

        <label for="alergi">Alergi:</label>
        <input type="text" name="alergi" id="alergi"><br>

        <label for="tekanan_darah">Tekanan Darah:</label>
        <input type="text" name="tekanan_darah" id="tekanan_darah"><br>

        <label for="suhu_badan">Suhu Badan:</label>
        <input type="number" name="suhu_badan" id="suhu_badan" step="0.1"><br>

        <label for="tinggi_badan">Tinggi Badan:</label>
        <input type="number" name="tinggi_badan" id="tinggi_badan"><br>

        <label for="berat_badan">Berat Badan:</label>
        <input type="number" name="berat_badan" id="berat_badan" step="0.1"><br>

        <button type="submit">Kirim</button>
    </form>
</body>

</html>
