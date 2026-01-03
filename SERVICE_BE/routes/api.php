<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountAPI;
use App\Http\Controllers\LevelAPI;
use App\Http\Controllers\ProdukAPI;
use App\Http\Controllers\TeknisiAPI;

/*

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/testing_api', function (){

    return response()->json( ['testing' => "shandy"] );

});

Route::controller(AccountAPI::class)->group(function(){
    Route::get('/account/get_data', 'get_data');
    Route::get('/account/get_row', 'get_row');
    Route::post('/account/post_tambah_data', 'post_tambah_data');
    Route::post('/account/post_update_data', 'post_update_data');
});

Route::controller(LevelAPI::class)->group(function(){
    Route::get('/level/get_data', 'get_data');
    Route::get('/level/get_row', 'get_row');
    Route::post('/level/post_tambah_data', 'post_tambah_data');
});

Route::controller(ProdukAPI::class)->group(function(){
    Route::get('/produk/get_data', 'get_data');
    Route::get('/produk/get_row', 'get_row');
    Route::post('/produk/post_tambah_data', 'post_tambah_data');
});

Route::controller(TeknisiAPI::class)->group(function(){
    Route::get('/teknisi/get_data', 'get_data');
    Route::get('/teknisi/get_row', 'get_row');
    Route::post('/teknisi/post_tambah_data', 'post_tambah_data');
});

