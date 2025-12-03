<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProgramKerjaController;


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

Route::get('/', function () {
    return view('landing');
});

// Route Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);

// Route untuk menampilkan halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route untuk Logout (Method POST demi keamanan)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// GROUP ROUTE: Hanya bisa diakses jika sudah login (auth)
Route::middleware(['auth'])->group(function () {

    // --- PERHATIKAN BAGIAN INI ---
    
    // SALAH (Penyebab Error):
    // Route::get('/dashboard/anggota', function() { return view('dashboard.anggota'); });
    
    // BENAR (Menggunakan Controller):
    Route::get('/dashboard/admin', [DashboardController::class, 'indexAdmin'])->name('dashboard.admin');
    Route::get('/dashboard/anggota', [DashboardController::class, 'indexAnggota'])->name('dashboard.anggota');
    Route::get('admin/kas/cetak-pdf', [KasController::class, 'cetakLaporan'])->name('kas.pdf');
    Route::get('admin/progja/cetak-pdf', [ProgramKerjaController::class, 'cetakLaporan'])->name('progja.pdf');
    Route::get('admin/progja/{progja}/cetak-detail', [ProgramKerjaController::class, 'cetakDetailPdf'])->name('progja.detail.pdf');
    Route::resource('admin/anggota', AnggotaController::class);
    Route::resource('admin/kas', KasController::class)->parameters(['kas' => 'kas']);
    Route::resource('admin/progja', ProgramKerjaController::class)->parameters(['progja' => 'progja']);

});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/', [HomeController::class, 'index'])->name('landing');