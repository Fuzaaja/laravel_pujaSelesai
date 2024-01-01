<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PegawaiController;
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
    return view('layout.index');
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
