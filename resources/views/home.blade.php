@extends('layouts.sbadmin2')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-columns d-flex p-3">
        <!-- Card Jumlah Mahasiswa -->
        <div class="card " style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Jumlah Mahasiswa</h5>
                <h1 class="card-subtitle mb-2 text-muted">{{ $jumlahMahasiswa }}</h1>
                <canvas id="mahasiswaChart" width="400" height="200"></canvas>
            </div>
        </div>
        <!-- Card Jumlah Obat -->
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Jumlah Obat</h5>
                <h1 class="card-subtitle mb-2 text-muted">{{ $jumlahObat }}</h1>
                <canvas id="obatChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Data untuk chart mahasiswa
    var dataMahasiswa = {!! json_encode($dataChart) !!};
    var ctxMahasiswa = document.getElementById('mahasiswaChart').getContext('2d');
    var mahasiswaChart = new Chart(ctxMahasiswa, {
        type: 'bar',
        data: {
            labels: dataMahasiswa.labels,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: dataMahasiswa.data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk chart obat
    var dataObat = {!! json_encode($dataObatChart) !!};
    var ctxObat = document.getElementById('obatChart').getContext('2d');
    var obatChart = new Chart(ctxObat, {
        type: 'bar',
        data: {
            labels: dataObat.labels,
            datasets: [{
                label: 'Jumlah Obat',
                data: dataObat.data,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
