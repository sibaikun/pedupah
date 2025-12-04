<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PengaduanController;

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

    return $user->its_admin == 1
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');

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

        // Surat Admin
        Route::prefix('surats')->name('surats.')->group(function () {
            Route::get('/', [SuratController::class, 'adminIndex'])->name('index');
            Route::get('/{id}', [SuratController::class, 'show'])->name('show');
            Route::patch('/{id}/approve', [SuratController::class, 'approve'])->name('approve');
            Route::patch('/{id}/reject', [SuratController::class, 'reject'])->name('reject');
        });

        // Pengaduan Admin (opsional - untuk mengelola pengaduan)
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