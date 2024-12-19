<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panduan;

class PanduanController extends Controller
{
    // Menampilkan daftar panduan dengan fitur pencarian
    public function index(Request $request)
    {
        // Membangun query untuk Panduan
        $query = Panduan::query();

        // Jika ada parameter pencarian
        if ($request->has('search') && $request->search != '') {
            // Menambahkan pencarian berdasarkan judul dan konten
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('konten', 'like', '%' . $request->search . '%');
        }

        // Mengambil semua data panduan
        $panduans = $query->get();

        // Mengirimkan data panduan ke view
        return view('panduan.index', compact('panduans'));
    }

    // Menampilkan form untuk membuat panduan
    public function create()
    {
        return view('panduan.create');
    }

    // Menyimpan panduan yang baru dibuat
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
        ]);

        // Menyimpan panduan baru
        Panduan::create($request->all());
        return redirect()->route('dokter.panduan.index')->with('success', 'Panduan berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit panduan
    public function edit($id)
    {
        $panduan = Panduan::findOrFail($id);
        return view('panduan.edit', compact('panduan'));
    }

    // Memperbarui panduan yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
        ]);

        // Mencari panduan yang akan diperbarui
        $panduan = Panduan::findOrFail($id);
        $panduan->update($request->all());

        return redirect()->route('dokter.panduan.index')->with('success', 'Panduan berhasil diperbarui.');
    }

    // Menghapus panduan
    public function destroy($id)
    {
        $panduan = Panduan::findOrFail($id);
        $panduan->delete();

        return redirect()->route('dokter.panduan.index')->with('success', 'Panduan berhasil dihapus.');
    }
}
    