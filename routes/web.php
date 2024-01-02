<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\PrestasiController;
use App\Models\Kepala;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = array(
        'kepala' => Kepala::all(),
        'prestasi' => Prestasi::all(),
    );
    return view('layout.index', $data);
});

// Route::get('/buku', function () {
//     return view('buku.index');
// });


Route::resource('pegawai', PegawaiController::class);


Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::resource('siswa', SiswaController::class);


Route::get('/tampilan', [SiswaController::class, 'show'])->name('siswa.show');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/kepala', [KepalaController::class, 'index'])->name('kepala.show');
Route::resource('kepala', KepalaController::class);

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.show');
Route::resource('prestasi', PrestasiController::class);