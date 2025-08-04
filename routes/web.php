<?php

use App\Http\Controllers\AnggotakeluargaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route Utama
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PortalController::class, 'homepage']);

// Auth
// Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

// Route Dashboard
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard')->middleware('role:Admin,User');

// Route untuk Rumah
Route::prefix('rumah')->middleware('role:Admin,User')->group(function () {
    Route::get('/', [RumahController::class, 'index'])->name('rumah.index');
    Route::get('/create', [RumahController::class, 'create'])->name('rumah.create');
    Route::post('/', [RumahController::class, 'store'])->name('rumah.store');
    Route::get('/{rumah}', [RumahController::class, 'show'])->name('rumah.show');
    Route::get('/{rumah}/edit', [RumahController::class, 'edit'])->name('rumah.edit');
    Route::put('/{rumah}', [RumahController::class, 'update'])->name('rumah.update');
    Route::delete('/{rumah}', [RumahController::class, 'destroy'])->name('rumah.destroy');

    // Nested Route untuk Penghuni
    Route::prefix('/{rumah}/penghuni')->group(function () {
        Route::get('/', [PenghuniController::class, 'index'])->name('rumah.penghuni.index');
        Route::get('/create', [PenghuniController::class, 'create'])->name('rumah.penghuni.create');
        Route::post('/', [PenghuniController::class, 'store'])->name('rumah.penghuni.store');
        Route::get('/{penghuni}', [PenghuniController::class, 'show'])->name('rumah.penghuni.show');
        Route::get('/{penghuni}/edit', [PenghuniController::class, 'edit'])->name('rumah.penghuni.edit');
        Route::put('/{penghuni}', [PenghuniController::class, 'update'])->name('rumah.penghuni.update');
        Route::delete('/{penghuni}', [PenghuniController::class, 'destroy'])->name('rumah.penghuni.destroy');
    });

    // Nested Route untuk Anggotakeluarga
    Route::prefix('/{rumah}/penghuni/{penghuni}/anggotakeluarga')->group(function () {
        Route::get('/', [AnggotakeluargaController::class, 'index'])->name('penghuni.anggotakeluarga.index');
        Route::get('/create', [AnggotakeluargaController::class, 'create'])->name('penghuni.anggotakeluarga.create');
        Route::post('/', [AnggotakeluargaController::class, 'store'])->name('penghuni.anggotakeluarga.store');
        Route::get('/{anggotakeluarga}', [AnggotakeluargaController::class, 'show'])->name('penghuni.anggotakeluarga.show');
        Route::get('/{anggotakeluarga}/edit', [AnggotakeluargaController::class, 'edit'])->name('penghuni.anggotakeluarga.edit');
        Route::put('/{anggotakeluarga}', [AnggotakeluargaController::class, 'update'])->name('penghuni.anggotakeluarga.update');
        Route::delete('/{anggotakeluarga}', [AnggotakeluargaController::class, 'destroy'])->name('penghuni.anggotakeluarga.destroy');
    });
});

Route::get('/account-list', [UserController::class, 'account_list_view'])->middleware('role:Admin');

Route::get('/account-request', [UserController::class, 'account_request_view'])->middleware('role:Admin');
Route::post('/account-request/approval/{id}', [UserController::class, 'account_approval'])->middleware('role:Admin');

Route::get('/profile', [UserController::class, 'profile_view'])->middleware('role:Admin,User');
Route::post('/profile/{id}', [UserController::class, 'update_profile'])->middleware('role:Admin,User');
Route::get('/change-password', [UserController::class, 'change_password_view'])->middleware('role:Admin,User');
Route::post('/change-password/{id}', [UserController::class, 'change_password'])->middleware('role:Admin,User');