<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\KasirAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [KasirAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [KasirAuthController::class, 'logout']);
    Route::get('/listKategori', [ProdukController::class, 'getKategoriProduk']);
    Route::get('/allProduk', [ProdukController::class, 'getProducts']);
});
