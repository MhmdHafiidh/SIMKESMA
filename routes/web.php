<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegistrasiPasienController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [RegistrasiPasienController::class, 'create']);
Route::resource('registrasipasien', RegistrasiPasienController::class);

Route::post('/login/mahasiswa', [LoginController::class, 'mahasiswaLogin'])->name('login.mahasiswa.submit');
Route::get('/dashboard/mahasiswa', [LoginController::class, 'dashboardMahasiswa'])->name('mahasiswa.dashboard')->middleware('auth');

Route::post('/login/dokter', [LoginController::class, 'dokterLogin'])->name('login.dokter.submit');
Route::get('/dashboard/dokter', [LoginController::class, 'dashboardDokter'])->name('dokter.dashboard')->middleware('auth');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('user', UserController::class)->middleware(Admin::class);
    Route::resource('profil', ProfilController::class);
    //buat middleware dengan perintah php artisan make:middleware Admin lalu modif kodenya \App\Http\Middleware\Admin.php
    Route::resource('obat', ObatController::class)->middleware(Admin::class);
});

Route::get('/register', [MahasiswaController::class, 'create'])->name('register');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

//membuat route logout
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Auth::routes([
    //menghilangkan fungsi register di halaman login
    'register' => false
]);
