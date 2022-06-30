<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LabaController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TestController;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('produk', ProdukController::class);
// Route::post('produk', [TestController::class, 'store']);
Route::resource('kategori', KategoriController::class);
Route::resource('pos', PosController::class);
Route::get('laba', [LabaController::class, 'laba']);
