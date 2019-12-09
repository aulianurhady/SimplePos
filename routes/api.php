<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'api'], function () {
//     Route::get('pengguna', 'UserController@getDataLogin');
//     Route::get('semua-barang', 'ItemController@getAllItem');
//     Route::get('semua-transaksi', 'TransactionController@getAllTransaction');
// });

Route::get('/product/{id}', 'TransactionController@getProduct');

Route::group(['middleware' => ['role:kasir']], function() {
    Route::get('/transaksi', 'TransactionController@addOrder')->name('transaksi.transaksi');
});
