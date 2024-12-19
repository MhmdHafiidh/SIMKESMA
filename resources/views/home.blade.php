@extends('layouts.sbadmin2')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-columns d-flex flex-wrap p-3 justify-content-around">
        <!-- Card Jumlah Mahasiswa -->
        <div class="card shadow-lg" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title text-primary">Jumlah Mahasiswa</h5>
                <h1 class="card-subtitle mb-3 text-muted">{{ $jumlahMahasiswa }}</h1>
                <canvas id="mahasiswaChart" width="400" height="400"></canvas>
            </div>
        </div>
        <!-- Card Jumlah Obat -->
        <div class="card shadow-lg" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title text-danger">Jumlah Obat</h5>
                <h1 class="card-subtitle mb-3 text-muted">{{ $jumlahObat }}</h1>
                <canvas id="obatChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Data untuk chart mahasiswa (Doughnut Chart)
    var dataMahasiswa = {!! json_encode($dataChart) !!};
    var ctxMahasiswa = document.getElementById('mahasiswaChart').getContext('2d');
    var mahasiswaChart = new Chart(ctxMahasiswa, {
        type: 'doughnut',
        data: {
            labels: dataMahasiswa.labels,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: dataMahasiswa.data,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribusi Jumlah Mahasiswa'
                }
            }
        }
    });

    // Data untuk chart obat (Line Chart)
    var dataObat = {!! json_encode($dataObatChart) !!};
    var ctxObat = document.getElementById('obatChart').getContext('2d');
    var obatChart = new Chart(ctxObat, {
        type: 'line',
        data: {
            labels: dataObat.labels,
            datasets: [{
                label: 'Jumlah Obat',
                data: dataObat.data,
                fill: false,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                tension: 0.4, // Memberikan efek lengkung halus pada garis
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Trend Jumlah Obat'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
