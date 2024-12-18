<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Obat;

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
        // Jumlah mahasiswa
        $jumlahMahasiswa = Mahasiswa::count();

        // Data chart mahasiswa
        $studentsByProdi = Mahasiswa::groupBy('prodi')->selectRaw('prodi, count(*) as jumlah_mahasiswa')->get();
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

        // Jumlah obat
        $jumlahObat = Obat::count();

        // Data chart obat
        $obatData = Obat::select('nama_obat', 'qty')->get();
        $obatLabels = $obatData->pluck('nama_obat')->toArray();
        $obatQuantities = $obatData->pluck('qty')->toArray();

        $dataObatChart = [
            'labels' => $obatLabels,
            'data' => $obatQuantities,
        ];

        // Return data to the view
        return view('home', compact('studentsByProdi', 'dataChart', 'jumlahMahasiswa', 'jumlahObat', 'dataObatChart'));
    }
}
