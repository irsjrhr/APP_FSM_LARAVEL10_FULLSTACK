<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Index; //---> Folder Layer Controller Aplikasi SPA Admin
use App\Http\Controllers\Modul; //---> Folder Layer Controller Aplikasi SPA Admin

Route::get('/', function () {
    return view('welcome');
});

//+++++++++++++++++++ APLIKASI SPA ADMIN ROUTE  /admin ++++++++++++++++++++
//Source Folder Aplikasi Layer : App\Http\Controllers\Admin

//=== route entry controller SPA Modul Aplikasi  =======
Route::controller(Index::class)->group(function () {
    Route::get('/admin', 'index' )->name('Admin.index'); 
});
//=== End Of route entry controller SPA Modul Aplikasi   =======

//==== Route Modul Dashboard
//Source Controller Modul : App\Http\Controllers\Modul_dashboard
//Source View : resource\view\Modul_dashboard
Route::controller(Modul\Modul_dashboard::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/dashboard', 'dashboard');
});
//==== Route Modul Account
//Source Controller Modul : App\Http\Controllers\Modul_account
//Source View : resource\view\Modul_account
Route::controller(Modul\Modul_account::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/account', 'account');
    Route::get('/admin/level', 'level');
});
//==== Route Modul FSM
//Source Controller Modul : App\Http\Controllers\Modul_FSM
//Source View : resource\view\Modul_FSM
Route::controller(Modul\Modul_FSM::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/produk', 'produk');
    Route::get('/admin/project', 'project');
    Route::get('/admin/laporan', 'laporan');
    Route::get('/admin/monitoring', 'monitoring');
    Route::get('/admin/teknisi', 'teknisi');

});
//==== Route Modul Transaksi
//Source Controller Modul : App\Http\Controllers\Modul_transaksi
//Source View : resource\view\Modul_transaksi
Route::controller(Modul\Modul_transaksi::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/transaksi_kategori', 'kategori');
    Route::get('/admin/transaksi_pemasukan', 'pemasukan');
    Route::get('/admin/transaksi_pengeluaran', 'pengeluaran');
    Route::get('/admin/transaksi_pembayaran', 'pembayaran');
});


Route::controller(Modul\Modul_teknisi::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/teknisi/project', 'project');
    Route::get('/teknisi/monitoring', 'monitoring');
});


//==== Route Modul General 
//Source Controller Modul : App\Http\Controllers\User\Modul
//Source View : resource\view\User\Modul
Route::controller(Modul\Modul_user::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/user/profile', 'profile');
    Route::get('/user/project', 'project');
    Route::get('/user/tambah_project', 'tambah_project');
    Route::get('/user/monitoring', 'monitoring');
});















