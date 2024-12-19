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
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\ChatController;



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
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');


Route::post('/login/dokter', [LoginController::class, 'dokterLogin'])->name('login.dokter.submit');
Route::get('/dashboard/dokter', [LoginController::class, 'dashboardDokter'])->name('dokter.dashboard')->middleware('auth');


Route::middleware(Authenticate::class)->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('obat', ObatController::class)->middleware('manage.obat');
    // Resource lainnya tetap menggunakan middleware yang ada
    Route::resource('user', UserController::class)->middleware(Admin::class);

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages/{id}', [ChatController::class, 'fetchMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
    Route::post('/chat/mark-as-read', [ChatController::class, 'markAsRead']);
    Route::get('/chat/check-unread', [ChatController::class, 'checkUnreadMessages']);


});

Route::get('/register', [MahasiswaController::class, 'create'])->name('register');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::post('/login', [MahasiswaController::class, 'login'])->name('login');



//membuat route logout
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Auth::routes([
    //menghilangkan fungsi register di halaman login
    'register' => false
]);

// Routes untuk Dokter
Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::resource('panduan', PanduanController::class)->names([
        'index' => 'dokter.panduan.index',
        'create' => 'dokter.panduan.create',
        'store' => 'dokter.panduan.store',
        'edit' => 'dokter.panduan.edit',
        'update' => 'dokter.panduan.update',
        'destroy' => 'dokter.panduan.destroy',
    ]);
});

// Routes untuk Mahasiswa
Route::prefix('mahasiswa')->middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('panduan', [PanduanController::class, 'index'])->name('mahasiswa.panduan.index');
});
