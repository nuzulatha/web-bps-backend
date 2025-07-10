<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublikasiController;

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
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () { 
    // Endpoint untuk Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Endpoint untuk Publikasi
    // GET /api/publikasi/{id} -> Menampilkan detail
    Route::get('/publikasi/{publikasi}', [PublikasiController::class, 'show']);

    // PUT /api/publikasi/{id} -> Mengubah data
    Route::put('/publikasi/{publikasi}', [PublikasiController::class, 'update']);

    // DELETE /api/publikasi/{id} -> Menghapus data
    Route::delete('/publikasi/{publikasi}', [PublikasiController::class, 'destroy']);
    
    // Publikasi 
    Route::get('/publikasi', [PublikasiController::class, 'index']); 
    Route::post('/publikasi', [PublikasiController::class, 'store']); 
}); 
