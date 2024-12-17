<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequests extends FormRequest
{
    public function rules()
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahas_table_v2,nim|max:20',
            'email' => 'required|email|unique:mahas_table_v2,email|max:255',  // Validasi email
            'password' => 'required|string|min:8|confirmed',  // Validasi password
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'prodi' => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2010|max:' . (date('Y') + 1)
        ];
    }

    public function messages()
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nim.required' => 'NIM harus diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'email.required' => 'Email harus diisi',  // Pesan untuk email
            'email.email' => 'Format email tidak valid',  // Format email tidak valid
            'email.unique' => 'Email sudah terdaftar',  // Email sudah ada
            'password.required' => 'Password harus diisi',  // Pesan untuk password
            'password.min' => 'Password minimal 8 karakter',  // Password minimal 8 karakter
            'password.confirmed' => 'Konfirmasi password tidak cocok',  // Konfirmasi password tidak cocok
            'prodi.required' => 'Program studi harus dipilih',
            'angkatan.required' => 'Angkatan harus dipilih'
        ];
    }
}
