<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    // Mahasiswa creates new rekam medis
    public function create()
    {
        return view('rekam_medis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keluhan' => 'required|string',
            'gejala' => 'required|string',
            'riwayat_penyakit' => 'nullable|string',
            'alergi' => 'nullable|string',
            'tekanan_darah' => 'nullable|string',
            'suhu_badan' => 'nullable|integer',
            'tinggi_badan' => 'nullable|integer',
            'berat_badan' => 'nullable|numeric',
        ]);

        RekamMedis::create([
            'mahasiswa_id' => auth()->id(),
            'keluhan' => $validated['keluhan'],
            'gejala' => $validated['gejala'],
            'riwayat_penyakit' => $validated['riwayat_penyakit'],
            'alergi' => $validated['alergi'],
            'tekanan_darah' => $validated['tekanan_darah'],
            'suhu_badan' => $validated['suhu_badan'],
            'tinggi_badan' => $validated['tinggi_badan'],
            'berat_badan' => $validated['berat_badan'],
            'status' => 'menunggu',
        ]);

        return redirect()->route('rekam_medis.index_mahasiswa')->with('success', 'Rekam medis berhasil dibuat.');
    }

    // Mahasiswa views their rekam medis
    public function indexMahasiswa()
    {
        $rekamMedis = RekamMedis::where('mahasiswa_id', auth()->id())->get();
        return view('rekam_medis.index_mahasiswa', compact('rekamMedis'));
    }

    // Dokter views list of rekam medis
    public function indexDokter()
    {
        $rekamMedis = RekamMedis::where('status', '!=', 'selesai')->get();
        return view('rekam_medis.index_dokter', compact('rekamMedis'));
    }

    // Dokter views details of a rekam medis
    public function show($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        return view('rekam_medis.show', compact('rekamMedis'));
    }

    // Dokter updates diagnosis and tindakan
    public function updateDiagnosis(Request $request, $id)
    {
        $validated = $request->validate([
            'diagnosis' => 'required|string',
            'tindakan' => 'required|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update([
            'diagnosis' => $validated['diagnosis'],
            'tindakan' => $validated['tindakan'],
            'status' => 'selesai',
            'tanggal_selesai' => now(),
        ]);

        return redirect()->route('rekam_medis.index_dokter')->with('success', 'Diagnosis dan tindakan berhasil disimpan.');
    }
}