<?php

use App\Http\Controllers\RumahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/rumah', [RumahController::class, 'index'])->name('rumah.index');
Route::get('/rumah/create', [RumahController::class, 'create'])->name('rumah.create');
Route::get('/rumah/{id}', [RumahController::class, 'edit'])->name('rumah.edit');
Route::post('/rumah', [RumahController::class, 'store'])->name('rumah.store');
Route::put('/rumah/{id}', [RumahController::class, 'update'])->name('rumah.update');
Route::delete('/rumah/{id}', [RumahController::class, 'destroy'])->name('rumah.delete');
