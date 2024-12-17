<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreMahasiswaRequests;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function create()
    {
        $prodi = [
            'Teknik Informatika',
            'Teknik Elektro', 
            'Teknik Mesin',
            'Teknik Sipil',
            'Sistem Informasi',
            'Teknik Kimia'
        ];

        $angkatan = range(date('Y'), date('Y') - 10);

        return view('auth.register', compact('prodi', 'angkatan'));
    }

    public function store(StoreMahasiswaRequests $request)
    {
        $validatedData = $request->validated();

        try {
            $mahasiswa = Mahasiswa::create($validatedData);
            
            return redirect()->route('register')
                ->with('success', 'Registrasi Mahasiswa Berhasil!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}

