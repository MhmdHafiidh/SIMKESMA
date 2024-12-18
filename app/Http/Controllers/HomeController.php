<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
            // Group students by prodi and count the number of students in each group
        $studentsByProdi = Mahasiswa::groupBy('prodi')->selectRaw('prodi, count(*) as jumlah_mahasiswa')->get();

        // Prepare data for the chart
        $labels = [];
        $data = [];
        foreach ($studentsByProdi as $prodi) {
            $labels[] = $prodi->prodi;
            $data[] = $prodi->jumlah_mahasiswa;
        }

        $dataChart = [
            'labels' => $labels,
            'data' => $data,
        ];

    return view('home', compact('studentsByProdi', 'dataChart', 'jumlahMahasiswa'));
    }
}
