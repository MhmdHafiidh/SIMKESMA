<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rekam Medis</title>
</head>

<body>
    <h1>Daftar Rekam Medis Baru</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mahasiswa</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekamMedis as $rekam)
                <tr>
                    <td>{{ $rekam->id }}</td>
                    <td>{{ $rekam->mahasiswa->name }}</td>
                    <td>{{ $rekam->keluhan }}</td>
                    <td>{{ $rekam->status }}</td>
                    <td><a href="{{ route('rekam_medis.show', $rekam->id) }}">Lihat</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
