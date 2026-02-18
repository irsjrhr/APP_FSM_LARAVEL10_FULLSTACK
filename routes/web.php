<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin; //---> Folder Layer Controller Aplikasi SPA Admin
use App\Http\Controllers\Teknisi; //---> Folder Layer Controller Aplikasi SPA Teknisi
use App\Http\Controllers\User; //---> Folder Layer Controller Aplikasi SPA User
use App\Http\Controllers\Auth;

Route::get('/', function () {
    return view('welcome');
});

//+++++++++++++++++++ APLIKASI SPA ADMIN ROUTE  /admin ++++++++++++++++++++
//Source Folder Aplikasi Layer : App\Http\Controllers\Admin

//=== route entry controller SPA Modul Aplikasi Admin  =======
Route::controller(Admin\Index::class)->group(function () {
    Route::get('/admin', 'index' )->name('Admin.index'); 
});
//=== End Of route entry controller SPA Modul Aplikasi Admin   =======

//==== Route Modul General
//Source Controller Modul : App\Http\Controllers\Admin\Modul
//Source View : resource\view\Admin\Modul
Route::controller(Admin\Modul::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/dashboard', 'dashboard');
});
//==== Route Modul Account
//Source Controller Modul : App\Http\Controllers\Admin\Modul_account
//Source View : resource\view\Admin\Modul_account
Route::controller(Admin\Modul_account::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/account', 'account');
    Route::get('/admin/level', 'level');
});
//==== Route Modul FSM
//Source Controller Modul : App\Http\Controllers\Admin\Modul_FSM
//Source View : resource\view\Admin\Modul_FSM
Route::controller(Admin\Modul_FSM::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/produk', 'produk');
    Route::get('/admin/project', 'project');
    Route::get('/admin/laporan', 'laporan');
    Route::get('/admin/monitoring', 'monitoring');
    Route::get('/admin/teknisi', 'teknisi');

});
//==== Route Modul Transaksi
//Source Controller Modul : App\Http\Controllers\Admin\Modul_transaksi
//Source View : resource\view\Admin\Modul_transaksi
Route::controller(Admin\Modul_transaksi::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/admin/transaksi_kategori', 'kategori');
    Route::get('/admin/transaksi_pemasukan', 'pemasukan');
    Route::get('/admin/transaksi_pengeluaran', 'pengeluaran');
    Route::get('/admin/transaksi_pembayaran', 'pembayaran');
});


//+++++++++++++++++++ APLIKASI SPA Teknisi ROUTE  /teknisi ++++++++++++++++++++
//Source Folder Aplikasi Layer : App\Http\Controllers\Teknisi

//=== route entry controller SPA Modul Aplikasi Teknisis  =======
Route::controller(Teknisi\Index::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/teknisi', 'index')->name('teknisi.index');
});
//=== End Of route entry controller SPA Modul Aplikasi Teknisis  =======


//==== Route Modul General
//Source Controller Modul : App\Http\Controllers\Teknisi\Modul
//Source View : resource\view\Teknisi\Modul
Route::controller(Teknisi\Modul::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/teknisi/dashboard', 'dashboard');
    Route::get('/teknisi/project', 'project');
    Route::get('/teknisi/monitoring', 'monitoring');
});



//+++++++++++++++++++ APLIKASI SPA Teknisi ROUTE  /user ++++++++++++++++++++
//Source Folder Aplikasi Layer : App\Http\Controllers\User

//=== route entry controller SPA Modul Aplikasi User  =======
Route::controller(User\Index::class)->group(function () {
    Route::get('/user', 'index')->name('user.user');
});
//=== End Of route entry controller SPA Modul Aplikasi User  =======

//==== Route Modul General 
//Source Controller Modul : App\Http\Controllers\User\Modul
//Source View : resource\view\User\Modul
Route::controller(User\Modul::class)->group(function () {
    //==== Route Fitur ====
    Route::get('/user/dashboard', 'dashboard');
    Route::get('/user/profile', 'profile');
    Route::get('/user/project', 'project');
    Route::get('/user/tambah_project', 'tambah_project');
    Route::get('/user/monitoring', 'monitoring');
});



//+++++++++++++++++++ AUTH ROUTE ++++++++++++++++++++
Route::controller(Auth::class)->group(function () {

    Route::get('/auth', 'index');
    Route::get('/auth/set_sesi', 'set_sesi');
    Route::get('/auth/logout', 'logout');

});











