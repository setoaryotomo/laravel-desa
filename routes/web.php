<?php

use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\RumahController;
use Illuminate\Support\Facades\Route;

// Route Utama
Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Route untuk Rumah
Route::prefix('rumah')->group(function () {
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
});
