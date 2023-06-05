<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KelasSiswaController;


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

Route::get('/', [HomeController::class, 'index']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::resource('/user', UserController::class)->names(['index'=>'user.index']);
    Route::resource('/siswa', SiswaController::class)->names(['index'=>'siswa.index']);
    Route::resource('/guru', GuruController::class)->names(['index'=>'guru.index']);
    Route::resource('/kelas', KelasController::class)->names(['index'=>'kelas.index']);
    Route::get('/kelas/tambah-siswa/{id}', [KelasController::class, 'tambah'])->name('kelas.tambah-siswa');
    Route::put('/kelas/tambah-siswa/siswa/{siswaId}/tambah-ke-kelas/{kelasId}', [KelasController::class, 'tambahSiswa']);
    Route::delete('/kelas/hapus-siswa/{id}', [KelasController::class, 'hapusKelasId']);
    Route::controller(AbsensiController::class)->group(function () {
        Route::get('/absensi', 'index')->name('absensi.index');
        Route::get('/absensi/{id}', 'show');
        Route::post('/absensi', 'store');
    });

});
