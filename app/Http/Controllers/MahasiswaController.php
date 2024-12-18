<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreMahasiswaRequests;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{

    public function index()
{
    // Ambil semua data mahasiswa dari tabel mahas_table_v2
    $mahas_table_v2 = Mahasiswa::all();

    // Tampilkan view dengan data mahasiswa
    return view('mahasiswa_index', compact('mahas_table_v2'));
}
    // Menampilkan form registrasi
    public function create()
    {
        // Daftar program studi (prodi) yang bisa dipilih
        $prodi = [
            'Teknik Informatika',
            'Teknik Elektro',
            'Teknik Mesin',
            'Teknik Sipil',
            'Sistem Informasi',
            'Teknik Kimia'
        ];

        // Daftar angkatan (tahun)
        $angkatan = range(date('Y'), date('Y') - 10);

        // Menampilkan view form registrasi
        return view('auth.register', compact('prodi', 'angkatan'));
    }

    // Menyimpan data mahasiswa dan membuat akun pengguna
    public function store(StoreMahasiswaRequests $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validated();

        try {
            // 1. Buat akun di tabel users (untuk login)
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa', // Menandai role sebagai mahasiswa
                'name' => $request->nama_lengkap, // Tambahkan nama lengkap ke kolom 'name'
            ]);

            // 2. Simpan data mahasiswa di tabel mahas_table_v2
            $mahasiswa = Mahasiswa::create([
                'user_id' => $user->id,  // Relasi dengan tabel users
                'nama_lengkap' => $request->nama_lengkap,
                'nim' => $request->nim,
                'email' => $request->email, // Menambahkan email
                'password' => Hash::make($request->password),
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
            ]);

            // 3. Login otomatis setelah registrasi berhasil
            return back()->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan saat menyimpan data
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }


    public function login(Request $request)
    {
        // Validasi email dan password
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('mahasiswa.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }
}
