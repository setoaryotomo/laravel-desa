<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AnggotakeluargaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JenissuratController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route Utama
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [PortalController::class, 'homepage']);
Route::get('/detail-berita/{id}', [PortalController::class, 'berita'])->name('portal.berita');
Route::get('/detail-agenda/{id}', [PortalController::class, 'agenda'])->name('portal.agenda');
Route::get('/detail-gallery/{id}', [PortalController::class, 'gallery'])->name('portal.gallery');
Route::get('/portal-gallery/{gallery}', [PortalController::class, 'gallery'])->name('gallery');
Route::get('/portal-agenda/{agenda}', [PortalController::class, 'agenda'])->name('agenda');
Route::get('/api/search', [PortalController::class, 'apiSearch'])->name('api.search');

// Auth
// Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('role:Admin,User');

// Route Dashboard
// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// })->name('dashboard')->middleware('role:Admin,User');

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


Route::prefix('berita')->middleware('role:Admin,User')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/{berita}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

Route::prefix('agenda')->middleware('role:Admin,User')->group(function () {
    Route::get('/', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/create', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/{agenda}', [AgendaController::class, 'show'])->name('agenda.show');
    Route::get('/{agenda}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/{agenda}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/{agenda}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
});

Route::prefix('gallery')->middleware('role:Admin,User')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/{gallery}', [GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
});

Route::prefix('jenissurat')->middleware('role:Admin,User')->group(function () {
    Route::get('/', [JenissuratController::class, 'index'])->name('jenissurat.index');
    Route::get('/create', [JenissuratController::class, 'create'])->name('jenissurat.create');
    Route::post('/', [JenissuratController::class, 'store'])->name('jenissurat.store');
    Route::get('/{jenissurat}', [JenissuratController::class, 'show'])->name('jenissurat.show');
    Route::get('/{jenissurat}/edit', [JenissuratController::class, 'edit'])->name('jenissurat.edit');
    Route::put('/{jenissurat}', [JenissuratController::class, 'update'])->name('jenissurat.update');
    Route::delete('/{jenissurat}', [JenissuratController::class, 'destroy'])->name('jenissurat.destroy');
});

Route::prefix('surat')->middleware('role:Admin,User')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/{surat}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/{surat}/email', [SuratController::class, 'mail'])->name('surat.mail');
    Route::get('/{surat}/tolak', [SuratController::class, 'tolak'])->name('surat.tolak');
    Route::get('/{surat}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/{surat}', [SuratController::class, 'update'])->name('surat.update');
    Route::delete('/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');
});

// Route::post('/permohonan', [SuratController::class, 'permohonan'])->name('permohonan');
Route::post('/permohonan', [PortalController::class, 'permohonan'])->name('permohonan');

Route::get('/api/autocomplete-resident', [PortalController::class, 'apiAutocompleteResident']);

Route::get('/account-list', [UserController::class, 'account_list_view'])->middleware('role:Admin');
Route::get('/account-request', [UserController::class, 'account_request_view'])->middleware('role:Admin');
Route::post('/account-request/approval/{id}', [UserController::class, 'account_approval'])->middleware('role:Admin');

Route::get('/profile', [UserController::class, 'profile_view'])->middleware('role:Admin,User');
Route::post('/profile/{id}', [UserController::class, 'update_profile'])->middleware('role:Admin,User');
Route::get('/change-password', [UserController::class, 'change_password_view'])->middleware('role:Admin,User');
Route::post('/change-password/{id}', [UserController::class, 'change_password'])->middleware('role:Admin,User');