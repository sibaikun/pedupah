<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SuratOfflineController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\SuratKeluarController;

/*
|--------------------------------------------------------------------------
| Redirect Setelah Login
|--------------------------------------------------------------------------
| Semua user (admin / user) setelah login akan diarahkan ke route ini.
| Breeze mengarahkan ke: RouteServiceProvider::HOME
| Jadi set di sana ke route('redirect.login')
*/
Route::get('/redirect-login', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->its_admin == 1) {
        return redirect()->route('admin.dashboard');
    }
    
    return redirect()->route('dashboard');
})->middleware(['auth'])->name('redirect.login');



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');
Route::get('/aduan', [LayananController::class, 'aduan'])->name('aduan');
Route::get('/pengajuan-surat', [LayananController::class, 'pengajuan'])->name('pengajuan.surat');



/*
|--------------------------------------------------------------------------
| User Routes (its_admin = 0)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'isUser'])
    ->prefix('/')
    ->group(function () {

        // Dashboard User
        Route::view('/dashboard', 'users.dashboard')->name('dashboard');

        // Surat User
        Route::prefix('surats')->name('surats.')->group(function () {
            Route::get('/', [SuratController::class, 'userIndex'])->name('index');
            Route::get('/create', [SuratController::class, 'create'])->name('create');
            Route::post('/', [SuratController::class, 'store'])->name('store');
        });

        // Pengaduan User
        Route::prefix('pengaduans')->name('pengaduans.')->group(function () {
            Route::get('/', [PengaduanController::class, 'index'])->name('index');
            Route::get('/create', [PengaduanController::class, 'create'])->name('create');
            Route::post('/', [PengaduanController::class, 'store'])->name('store');
        });

        // User Profile
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });
    });



/*
|--------------------------------------------------------------------------
| Admin Routes (its_admin = 1)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        // Surat Online Admin
        Route::prefix('surats')->name('surats.')->group(function () {
            Route::get('/', [SuratController::class, 'adminIndex'])->name('index');
            Route::get('/{id}', [SuratController::class, 'show'])->name('show');
            Route::get('/{id}/print', [SuratController::class, 'print'])->name('print');
            Route::patch('/{id}/approve', [SuratController::class, 'approve'])->name('approve');
            Route::patch('/{id}/reject', [SuratController::class, 'reject'])->name('reject');
            Route::post('/{id}/upload', [SuratController::class, 'uploadFile'])->name('upload');
        });

        // ===================================================================
        // SURAT MASUK - CRUD LENGKAP + PRINT
        // ===================================================================
        Route::prefix('surat-masuk')->name('surat-masuk.')->group(function () {
            // Custom routes HARUS di atas route dengan parameter dinamis
            Route::get('/create', [SuratMasukController::class, 'create'])->name('create');
            
            // List & Store
            Route::get('/', [SuratMasukController::class, 'index'])->name('index');
            Route::post('/', [SuratMasukController::class, 'store'])->name('store');
            
            // Show, Edit, Update, Delete, Print (dengan parameter ID)
            Route::get('/{id}', [SuratMasukController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [SuratMasukController::class, 'edit'])->name('edit');
            Route::get('/{id}/print', [SuratMasukController::class, 'print'])->name('print');
            Route::put('/{id}', [SuratMasukController::class, 'update'])->name('update');
            Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->name('destroy');
        });

        // ===================================================================
        // SURAT KELUAR - CRUD LENGKAP + PRINT
        // ===================================================================
        Route::prefix('surat-keluar')->name('surat-keluar.')->group(function () {
            // Custom routes HARUS di atas route dengan parameter dinamis
            Route::get('/create', [SuratKeluarController::class, 'create'])->name('create');
            
            // List & Store
            Route::get('/', [SuratKeluarController::class, 'index'])->name('index');
            Route::post('/', [SuratKeluarController::class, 'store'])->name('store');
            
            // Show, Edit, Update, Delete, Print (dengan parameter ID)
            Route::get('/{id}', [SuratKeluarController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [SuratKeluarController::class, 'edit'])->name('edit');
            Route::get('/{id}/print', [SuratKeluarController::class, 'print'])->name('print');
            Route::put('/{id}', [SuratKeluarController::class, 'update'])->name('update');
            Route::delete('/{id}', [SuratKeluarController::class, 'destroy'])->name('destroy');
        });

        // ===================================================================
        // SURAT OFFLINE (OPTIONAL - Jika masih mau pakai yang lama)
        // ===================================================================
        // Jika Anda ingin tetap mempertahankan route suratoffline yang lama,
        // bisa dibiarkan di bawah ini. Atau bisa dihapus jika sudah tidak dipakai.
        Route::prefix('suratoffline')->name('suratoffline.')->group(function () {
            // Halaman Index (List Surat Masuk & Keluar)
            Route::get('/', [SuratOfflineController::class, 'index'])->name('index');
            
            // Surat Masuk Routes (OLD)
            Route::get('/masuk/create', [SuratOfflineController::class, 'createMasuk'])->name('masuk.create');
            Route::post('/masuk', [SuratOfflineController::class, 'storeMasuk'])->name('masuk.store');
            Route::get('/masuk/{id}', [SuratOfflineController::class, 'showMasuk'])->name('masuk.show');
            Route::get('/masuk/{id}/edit', [SuratOfflineController::class, 'editMasuk'])->name('masuk.edit');
            Route::put('/masuk/{id}', [SuratOfflineController::class, 'updateMasuk'])->name('masuk.update');
            Route::delete('/masuk/{id}', [SuratOfflineController::class, 'destroyMasuk'])->name('masuk.destroy');
            
            // Surat Keluar Routes (OLD)
            Route::get('/keluar/create', [SuratOfflineController::class, 'createKeluar'])->name('keluar.create');
            Route::post('/keluar', [SuratOfflineController::class, 'storeKeluar'])->name('keluar.store');
            Route::get('/keluar/{id}', [SuratOfflineController::class, 'showKeluar'])->name('keluar.show');
            Route::get('/keluar/{id}/edit', [SuratOfflineController::class, 'editKeluar'])->name('keluar.edit');
            Route::put('/keluar/{id}', [SuratOfflineController::class, 'updateKeluar'])->name('keluar.update');
            Route::delete('/keluar/{id}', [SuratOfflineController::class, 'destroyKeluar'])->name('keluar.destroy');
        });

        // Pengaduan Admin
        Route::prefix('pengaduans')->name('pengaduans.')->group(function () {
            Route::get('/', [PengaduanController::class, 'adminIndex'])->name('index');
            Route::get('/{id}', [PengaduanController::class, 'adminShow'])->name('show');
            Route::patch('/{id}/proses', [PengaduanController::class, 'proses'])->name('proses');
            Route::patch('/{id}/selesai', [PengaduanController::class, 'selesai'])->name('selesai');
            Route::patch('/{id}/tolak', [PengaduanController::class, 'tolak'])->name('tolak');
        });
    });



/*
|--------------------------------------------------------------------------
| Auth Routes Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';