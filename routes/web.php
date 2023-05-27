<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
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

// fungsi login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('check_login', [LoginController::class, 'checkLogin']);
Route::get('logout', [LoginController::class, 'logout']);

// fungsi dashboard
Route::get('dashboard', [DashboardController::class, 'index']);

// fungsi account
Route::get('password', [PegawaiController::class, 'indexChangePass']);
Route::post('change-password/{id}', [PegawaiController::class, 'changePassword']);

// fungsi print laporan
Route::get('print-barang', [BarangController::class, 'print']);
Route::get('print-gudang', [GudangController::class, 'print']);
Route::get('print-pegawai', [PegawaiController::class, 'print']);
Route::get('print-kategori', [KategoriController::class, 'print']);
Route::get('print-outlet', [OutletController::class, 'print']);
Route::get('print-stok', [StokController::class, 'print']);
Route::get('print-mutasi', [MutasiController::class, 'print']);
Route::get('print-pengiriman', [PengirimanController::class, 'print']);
Route::get('print-supplier', [SupplierController::class, 'print']);
Route::get('print-transaksi', [TransaksiController::class, 'print']);
Route::get('print-detail/{id}', [TransaksiController::class, 'printDetail']);

// fungsi CRUD
Route::resource('pegawai', PegawaiController::class);
Route::resource('pengguna', PenggunaController::class);
Route::resource('barang', BarangController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('gudang', GudangController::class);
Route::resource('outlet', OutletController::class);
Route::resource('stok', StokController::class);
Route::resource('mutasi', MutasiController::class);
Route::resource('pengiriman', PengirimanController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('transaksi', TransaksiController::class);
