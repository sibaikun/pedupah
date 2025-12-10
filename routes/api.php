<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route untuk mendapatkan informasi user yang sedang login
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Public API Routes (Tidak perlu autentikasi)
|--------------------------------------------------------------------------
*/

// Contoh: Mendapatkan daftar jenis surat
// Route::get('/jenis-surat', function () {
//     return response()->json([
//         'success' => true,
//         'data' => [
//             'Surat Keterangan Domisili',
//             'Surat Keterangan Usaha',
//             'Surat Pengantar SKCK',
//             'Surat Keterangan Tidak Mampu',
//             'Lainnya'
//         ]
//     ]);
// });

/*
|--------------------------------------------------------------------------
| Protected API Routes (Perlu autentikasi)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    
    // API untuk Surat Pengajuan
    // Route::prefix('surats')->group(function () {
    //     Route::get('/', [SuratController::class, 'apiIndex']);
    //     Route::post('/', [SuratController::class, 'apiStore']);
    //     Route::get('/{id}', [SuratController::class, 'apiShow']);
    // });
    
    // API untuk Pengaduan
    // Route::prefix('pengaduans')->group(function () {
    //     Route::get('/', [PengaduanController::class, 'apiIndex']);
    //     Route::post('/', [PengaduanController::class, 'apiStore']);
    //     Route::get('/{id}', [PengaduanController::class, 'apiShow']);
    // });
    
});

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'isAdmin'])->prefix('admin')->group(function () {
    
    // API Admin untuk Surat
    // Route::prefix('surats')->group(function () {
    //     Route::get('/', [SuratController::class, 'apiAdminIndex']);
    //     Route::patch('/{id}/approve', [SuratController::class, 'apiApprove']);
    //     Route::patch('/{id}/reject', [SuratController::class, 'apiReject']);
    // });
    
    // API Admin untuk Pengaduan
    // Route::prefix('pengaduans')->group(function () {
    //     Route::get('/', [PengaduanController::class, 'apiAdminIndex']);
    //     Route::patch('/{id}/proses', [PengaduanController::class, 'apiProses']);
    //     Route::patch('/{id}/selesai', [PengaduanController::class, 'apiSelesai']);
    // });
    
});