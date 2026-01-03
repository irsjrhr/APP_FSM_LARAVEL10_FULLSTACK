<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Teknisi;
use App\Http\Controllers\User;
use App\Http\Controllers\Auth;

Route::get('/', function () {
    return view('welcome');
});

//+++++++++++++++++++ ADMIN ROUTE ++++++++++++++++++++



Route::controller(Admin::class)->group(function () {

    //=== Ini adalah route utama entry SPA Admin =======
    Route::get('/admin', 'index' )->name('admin.index');
    //=========================================
    //=== Ini adalah route view fitur/method yang akan di akses oleh JS untuk melakukan SPA di index =======
    Route::get('/admin/dashboard', 'dashboard');
    // Route Modul Account
    Route::get('/admin/account', 'account');
    Route::get('/admin/level', 'level');

    Route::get('/admin/teknisi', 'teknisi');
    Route::get('/admin/produk', 'produk');
    Route::get('/admin/project', 'project');
    Route::get('/admin/laporan', 'laporan');
    Route::get('/admin/monitoring', 'monitoring');

});



//+++++++++++++++++++ TEKNISI ROUTE ++++++++++++++++++++
Route::controller(Teknisi::class)->group(function () {

    //=== Ini adalah route utama entry SPA Teknisi =======
    Route::get('/teknisi', 'index')->name('teknisi.index');
    //=========================================================
    //=== Ini adalah route view fitur/method yang akan di akses oleh JS untuk melakukan SPA di index =======
    Route::get('/teknisi/dashboard', 'dashboard');
    // Route Modul Account
    Route::get('/teknisi/project', 'project');
    Route::get('/teknisi/submission_project', 'submission_project');

});


//+++++++++++++++++++ USER ROUTE ++++++++++++++++++++
Route::controller(User::class)->group(function () {

     //=== Ini adalah route utama entry SPA Teknisi =======
    Route::get('/user', 'index')->name('user.teknisi');
    //=========================================================
    //=== Ini adalah route view fitur/method yang akan di akses oleh JS untuk melakukan SPA di index =======
    Route::get('/user/dashboard', 'dashboard');
    // Route Modul Account
    Route::get('/user/profile', 'profile');
    Route::get('/user/project', 'project');
    Route::get('/user/tambah_project', 'tambah_project');
    Route::get('/user/monitoring', 'monitoring');

});





//+++++++++++++++++++ AUTH ROUTE ++++++++++++++++++++
Route::controller(User::class)->group(function () {

    Route::get('/auth', 'index');
    Route::get('/auth/set_sesi', 'set_sesi');
    Route::get('/auth/logout', 'logout');

});











