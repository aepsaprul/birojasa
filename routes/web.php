<?php

use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\NavController;
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

    // karyawan
    Route::get('master/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('master/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('master/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('master/karyawan/{id}/show', [KaryawanController::class, 'show'])->name('karyawan.show');
    Route::get('master/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('master/karyawan/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('master/karyawan/{id}/delete_btn', [KaryawanController::class, 'deleteBtn'])->name('karyawan.delete_btn');
    Route::post('master/karyawan/delete', [KaryawanController::class, 'delete'])->name('karyawan.delete');
    Route::post('karyawan/status', [KaryawanController::class, 'status'])->name('karyawan.status');
});
