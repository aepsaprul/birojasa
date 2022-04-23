<?php

use App\Http\Controllers\EstimasBiayaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    // master
        Route::get('master/nav', [NavController::class, 'index'])->name('nav.index');
        // nav main
        Route::post('master/nav/main_store', [NavController::class, 'mainStore'])->name('nav.main_store');
        Route::get('master/nav/{id}/main_edit', [NavController::class, 'mainEdit'])->name('nav.main_edit');
        Route::post('master/nav/main_update', [NavController::class, 'mainUpdate'])->name('nav.main_update');
        Route::get('master/nav/{id}/main_delete_btn', [NavController::class, 'mainDeleteBtn'])->name('nav.main_delete_btn');
        Route::post('master/nav/main_delete', [NavController::class, 'mainDelete'])->name('nav.main_delete');
        Route::post('master/nav/main_hirarki', [NavController::class, 'mainHirarki'])->name('nav.main_hirarki');

        // nav sub
        Route::get('master/nav/sub_create', [NavController::class, 'subCreate'])->name('nav.sub_create');
        Route::post('master/nav/sub_store', [NavController::class, 'subStore'])->name('nav.sub_store');
        Route::get('master/nav/{id}/sub_edit', [NavController::class, 'subEdit'])->name('nav.sub_edit');
        Route::post('master/nav/sub_update', [NavController::class, 'subUpdate'])->name('nav.sub_update');
        Route::get('master/nav/{id}/sub_delete_btn', [NavController::class, 'subDeleteBtn'])->name('nav.sub_delete_btn');
        Route::post('master/nav/sub_delete', [NavController::class, 'subDelete'])->name('nav.sub_delete');

        // user
        Route::get('master/user', [UserController::class, 'index'])->name('user.index');
        Route::get('master/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('master/user/store', [UserController::class, 'store'])->name('user.store');
        Route::post('master/user/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('master/user/{id}/access', [UserController::class, 'access'])->name('user.access');
        Route::put('master/user/{id}/access_save', [UserController::class, 'accessSave'])->name('user.access_save');
        Route::post('master/user/sync', [UserController::class, 'sync'])->name('user.sync');

        // jabatan
        Route::get('master/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::post('master/jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('master/jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::put('master/jabatan/{id}/update', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::get('master/jabatan/{id}/delete_btn', [JabatanController::class, 'deleteBtn'])->name('jabatan.delete_btn');
        Route::post('master/jabatan/delete', [JabatanController::class, 'delete'])->name('jabatan.delete');

        // kategori
        Route::get('master/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('master/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('master/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::post('master/kategori/update', [KategoriController::class, 'update'])->name('kategori.update');
        Route::get('master/kategori/{id}/delete_btn', [KategoriController::class, 'deleteBtn'])->name('kategori.delete_btn');
        Route::post('master/kategori/delete', [KategoriController::class, 'delete'])->name('kategori.delete');

        // estimasi biaya
        Route::get('master/estimasi_biaya', [EstimasBiayaController::class, 'index'])->name('estimasi_biaya.index');
        Route::get('master/estimasi_biaya/create', [EstimasBiayaController::class, 'create'])->name('estimasi_biaya.create');
        Route::post('master/estimasi_biaya/store', [EstimasBiayaController::class, 'store'])->name('estimasi_biaya.store');
        Route::get('master/estimasi_biaya/{id}/edit', [EstimasBiayaController::class, 'edit'])->name('estimasi_biaya.edit');
        Route::post('master/estimasi_biaya/update', [EstimasBiayaController::class, 'update'])->name('estimasi_biaya.update');
        Route::get('master/estimasi_biaya/{id}/delete_btn', [EstimasBiayaController::class, 'deleteBtn'])->name('estimasi_biaya.delete_btn');
        Route::post('master/estimasi_biaya/delete', [EstimasBiayaController::class, 'delete'])->name('estimasi_biaya.delete');

    // karyawan
    Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('karyawan/{id}/show', [KaryawanController::class, 'show'])->name('karyawan.show');
    Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('karyawan/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('karyawan/{id}/delete_btn', [KaryawanController::class, 'deleteBtn'])->name('karyawan.delete_btn');
    Route::post('karyawan/delete', [KaryawanController::class, 'delete'])->name('karyawan.delete');
    Route::post('karyawan/status', [KaryawanController::class, 'status'])->name('karyawan.status');

    // pelanggan
    Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('pelanggan/{id}/show', [PelangganController::class, 'show'])->name('pelanggan.show');
    Route::get('pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::post('pelanggan/update', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::get('pelanggan/{id}/delete_btn', [PelangganController::class, 'deleteBtn'])->name('pelanggan.delete_btn');
    Route::post('pelanggan/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');
});
