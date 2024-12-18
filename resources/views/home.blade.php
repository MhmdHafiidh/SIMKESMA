@extends('layouts.sbadmin2')

@section('content')
  <div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-body">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Jumlah Mahasiswa</h5>
            <h1 class="card-subtitle mb-2 text-muted">{{ $jumlahMahasiswa }}</h1>
            <canvas id="mahasiswaChart" width="400" height="200"></canvas>
        </div>
      </div>

    </div>
  </div>

  <script>
    // Ambil data dari controller (Assuming $dataChart is still populated)
    var data = {!! json_encode($dataChart) !!};

    var ctx = document.getElementById('mahasiswaChart').getContext('2d');
    var mahasiswaChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Jumlah Mahasiswa',
          data: data.data,
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
  </script>
@endsection