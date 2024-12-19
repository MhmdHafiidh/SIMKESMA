<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Http\Middleware\ManageObat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
        public function __construct()
    {
        $this->middleware('manage.obat');
    }

    public function index()
    {
        $obat = Obat::all();
        $judul = 'Data-data Obat';
        return view('obat_index',  compact('obat', 'judul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obat_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
            'satuan' => 'required',
            'tipe' => 'required',
            'qty' => 'required',
            'tanggal_expired' => 'required'
        ]);

        $obat = new Obat($validateData);
        $obat->kode_obat = $request->kode_obat;
        $obat->nama_obat = $request->nama_obat;
        $obat->satuan = $request->satuan;
        $obat->tipe = $request->tipe;
        $obat->qty = $request->qty;
        $obat->tanggal_expired = $request->tanggal_expired;
        $obat->save();

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_obat' => 'required|string',
            'nama_obat' => 'required|string',
            'satuan' => 'required|string',
            'tipe' => 'required|string',
            'qty' => 'required|integer|min:0',
            'tanggal_expired' => 'required|date',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($validatedData);

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Hapus data obat
        $obat->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus');
    }
}
