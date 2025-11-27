<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ComboBoxController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang-create', [BarangController::class, 'create']);
Route::post('/barang', [BarangController::class, 'store']);
Route::get('/barang-edit/{id}', [BarangController::class, 'edit']);
Route::PUT('/barang/{id}', [BarangController::class, 'update']);
Route::DELETE('/barang/{id}', [BarangController::class, 'delete']);

Route::get('/karyawan', [KasirController::class, 'index']);
Route::get('/karyawan-create', [KasirController::class, 'create']);
Route::post('/karyawan', [KasirController::class, 'store']);
Route::get('/karyawan-edit/{id}', [KasirController::class, 'edit']);
Route::PUT('/karyawan/{id}', [KasirController::class, 'update']);
Route::DELETE('/karyawan/{id}', [KasirController::class, 'delete']);

Route::get('/pemasok', [PemasokController::class, 'index']);
Route::get('/pemasok-create', [PemasokController::class, 'create']);
Route::post('/pemasok', [PemasokController::class, 'store']);
Route::get('/pemasok-edit/{id}', [PemasokController::class, 'edit']);
Route::PUT('/pemasok/{id}', [PemasokController::class, 'update']);
Route::DELETE('/pemasok/{id}', [PemasokController::class, 'delete']);

Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi-edit/{id}', [TransaksiController::class, 'edit']);
Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
Route::delete('/transaksi/{id}', [TransaksiController::class, 'drop']);
Route::get('/transaksi-restore', [TransaksiController::class, 'view_restore']);

Route::get('/transaksi-kasir', [TransaksiController::class, 'create']);
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::post('/transaksi-confirm', [TransaksiController::class, 'konfirmasi']);
Route::delete('/delete-transaksi/{id}', [TransaksiController::class, 'delete']);
Route::post('/transaksi-confirm', [TransaksiController::class, 'confirm']);







