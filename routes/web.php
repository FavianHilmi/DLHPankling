<?php
use App\Http\Controllers\ArsipUjiAirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPassiveController;
use App\Http\Controllers\DataKLHKController;
use App\Http\Controllers\DataPartikulatController;
use App\Http\Controllers\DataBeritaAcaraController;
use App\Http\Controllers\DataSPKUAController;
use App\Http\Controllers\UjiAirInternalController;
use App\Http\Controllers\UjiAirEksternalController;
use App\Http\Controllers\DataKawasanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GeneratePDFController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\MapsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;



// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rute dengan middleware otentikasi dan verifikasi
Route::get('/dashboard', [DashboardController::class, 'generateChart'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {

    // Route::get('/register', [RegisteredUserController::class, 'create'])
    //     ->middleware('auth', 'can:isAdmin')
    //     ->name('register');
    // Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
    // Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    // });

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('data_passive.index');
    // Route::get('/data_passive', [DataPassiveController::class, 'index'])->name('data_passive.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/download-template/{filename}', function ($filename) {
        $filePath = 'public/templates/' . $filename;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        } else {
            abort(404, 'File not found.');
        }
    });

    Route::get('/generate-pdf/{id}', [GeneratePDFController::class, 'generatePDF'])->name('generatePDF.index');

    // Route::get('/generate-pdf/{id}', [GeneratePDFController::class, 'generatePDF']);
    Route::get('/download-template/{type}', function ($type) {
        $templates = [
            'spkua' => 'app/templates/data_spkua_entry_form.xlsx',
            'partikulat' => 'app/templates/data_partikulat_entry_form.xlsx',
            'klhk' => 'app/templates/data_klhk_entry_form.xlsx',
        ];

        if (!array_key_exists($type, $templates)) {
            abort(404, 'Template not found');
        }

        return Storage::download($templates[$type]);
    })->name('download.template');

    Route::get('/form_data_passive', [DataPassiveController::class, 'create'])->name('data_passive.create');
    Route::get('/data_passive', [DataPassiveController::class, 'index'])->name('data_passive.index');
    Route::post('/data_passive', [DataPassiveController::class, 'store'])->name('data_passive.store');
    Route::resource('data_passive', DataPassiveController::class);
    Route::get('/data_passive/{id}/edit', [DataPassiveController::class, 'edit'])->name('data_passive.edit');
    Route::patch('/data_passive/{id}', [DataPassiveController::class, 'update'])->name('data_passive.update');
    Route::delete('/data_passive/{id}', [DataPassiveController::class, 'destroy'])->name('data_passive.destroy');
    Route::post('/data_passive/{id}/approve', [DataPassiveController::class, 'approve'])->name('data_passive.approve');
    Route::post('/data_passive/{id}/revisi', [DataPassiveController::class, 'revisi'])->name('data_passive.revisi');
    Route::get('/data_passive/import', [DataPassiveController::class, 'showImportForm'])->name('data_passive.importForm');
    Route::post('/data_passive/import/file', [DataPassiveController::class, 'import'])->name('data_passive.import');

    Route::get('/form_data_spkua', [DataSPKUAController::class, 'create'])->name('data_spkua.create');
    Route::post('/data_spkua', [DataSPKUAController::class, 'store'])->name('data_spkua.store');
    Route::resource('data_spkua', DataSPKUAController::class);
    Route::get('/data_spkua/{id}/edit', [DataSPKUAController::class, 'edit'])->name('data_spkua.edit');
    Route::patch('/data_spkua/{id}', [DataSPKUAController::class, 'update'])->name('data_spkua.update');
    Route::delete('/data_spkua/{id}', [DataSPKUAController::class, 'destroy'])->name('data_spkua.destroy');
    Route::post('/data_spkua/{id}/approve', [DataSPKUAController::class, 'approve'])->name('data_spkua.approve');
    Route::post('/data_spkua/{id}/revisi', [DataSPKUAController::class, 'revisi'])->name('data_spkua.revisi');
    Route::get('/data_spkua/import', [DataSPKUAController::class, 'showImportForm'])->name('data_spkua.importForm');
    Route::post('/data_spkua/import/file', [DataSPKUAController::class, 'import'])->name('data_spkua.import');

    Route::get('/form_data_partikulat', [DataPartikulatController::class, 'create'])->name('data_partikulat.create');
    Route::post('/data_partikulat', [DataPartikulatController::class, 'store'])->name('data_partikulat.store');
    Route::resource('data_partikulat', DataPartikulatController::class);
    Route::get('/data_partikulat/{id}/edit', [DataPartikulatController::class, 'edit'])->name('data_partikulat.edit');
    Route::patch('/data_partikulat/{id}', [DataPartikulatController::class, 'update'])->name('data_partikulat.update');
    Route::delete('/data_partikulat/{id}', [DataPartikulatController::class, 'destroy'])->name('data_partikulat.destroy');
    // Route::post('/data-partikulat/{id}/verify', [DataPartikulatController::class, 'verify'])->name('data_partikulat.verify');
    Route::post('/data_partikulat/{id}/approve', [DataPartikulatController::class, 'approve'])->name('data_partikulat.approve');
    Route::post('/data_partikulat/{id}/revisi', [DataPartikulatController::class, 'revisi'])->name('data_partikulat.revisi');
    Route::get('/data_partikulat/import', [DataPartikulatController::class, 'showImportForm'])->name('data_partikulat.importForm');
    Route::post('/data_partikulat/import/file', [DataPartikulatController::class, 'import'])->name('data_partikulat.import');
    Route::get('/download-partikulat', DataPartikulatController::class);

    Route::get('/form_arsip_uji_air', [ArsipUjiAirController::class, 'create'])->name('arsip_uji_air.create');
    Route::post('/arsip_uji_air', [ArsipUjiAirController::class, 'store'])->name('arsip_uji_air.store');
    Route::resource('arsip_uji_air', ArsipUjiAirController::class);
    Route::get('/arsip_uji_air/{id}/edit', [ArsipUjiAirController::class, 'edit'])->name('arsip_uji_air.edit');
    Route::patch('/arsip_uji_air/{id}', [ArsipUjiAirController::class, 'update'])->name('arsip_uji_air.update');
    Route::delete('/arsip_uji_air/{id}', [ArsipUjiAirController::class, 'destroy'])->name('arsip_uji_air.destroy');
    Route::post('/arsip_uji_air/{id}/verify', [ArsipUjiAirController::class, 'verify'])->name('arsip_uji_air.verify');
    Route::post('/arsip_uji_air/batch-approve', [ArsipUjiAirController::class, 'batchApprove'])->name('arsip_uji_air.batchApprove');
    Route::post('/arsip_uji_air/{id}/approve', [ArsipUjiAirController::class, 'approve'])->name('arsip_uji_air.approve');
    Route::post('/arsip_uji_air/{id}/revisi', [ArsipUjiAirController::class, 'revisi'])->name('arsip_uji_air.revisi');
    Route::get('/arsip_uji_air/import', [ArsipUjiAirController::class, 'showImportForm'])->name('arsip_uji_air.importForm');
    Route::post('/arsip_uji_air/import/file', [ArsipUjiAirController::class, 'import'])->name('arsip_uji_air.import');

    Route::get('/form_data_klhk', [DataKLHKController::class, 'create'])->name('data_klhk.create');
    Route::post('/data_klhk', [DataKLHKController::class, 'store'])->name('data_klhk.store');
    Route::resource('data_klhk', DataKLHKController::class);
    Route::get('/data_klhk/{id}/edit', [DataKLHKController::class, 'edit'])->name('data_klhk.edit');
    Route::patch('/data_klhk/{id}', [DataKLHKController::class, 'update'])->name('data_klhk.update');
    Route::delete('/data_klhk/{id}', [DataKLHKController::class, 'destroy'])->name('data_klhk.destroy');
    Route::post('/data_klhk/{id}/approve', [DataKLHKController::class, 'approve'])->name('data_klhk.approve');
    Route::post('/data_klhk/{id}/revisi', [DataKLHKController::class, 'revisi'])->name('data_klhk.revisi');
    Route::get('/data_klhk/import', [DataKLHKController::class, 'showImportForm'])->name('data_klhk.importForm');
    Route::post('/data_klhk/import/file', [DataKLHKController::class, 'import'])->name('data_klhk.import');

    Route::get('/data_kawasan', [DataKawasanController::class, 'index'])->name('data_kawasan.index');
    Route::get('/form_data_kawasan', [DataKawasanController::class, 'create'])->name('data_kawasan.create');
    Route::post('/data_kawasan', [DataKawasanController::class, 'store'])->name('data_kawasan.store');
    Route::resource('data_kawasan', DataKawasanController::class);
    Route::get('/data_kawasan/{id}/edit', [DataKawasanController::class, 'edit'])->name('data_kawasan.edit');
    Route::patch('/data_kawasan/{id}', [DataKawasanController::class, 'update'])->name('data_kawasan.update');
    Route::delete('/data_kawasan/{id}', [DataKawasanController::class, 'destroy'])->name('data_kawasan.destroy');
    Route::post('/data_kawasan/{id}/approve', [DataKawasanController::class, 'approve'])->name('data_kawasan.approve');
    Route::post('/data_kawasan/{id}/revisi', [DataKawasanController::class, 'revisi'])->name('data_kawasan.revisi');

    Route::get('/uji_air_internal', [UjiAirInternalController::class, 'index'])->name('uji_air_internal.index');
    Route::get('/form_uji_air_internal', [UjiAirInternalController::class, 'create'])->name('uji_air_internal.create');
    Route::post('/uji_air_internal', [UjiAirInternalController::class, 'store'])->name('uji_air_internal.store');
    Route::resource('uji_air_internal', UjiAirInternalController::class);
    Route::get('/uji_air_internal/{id}/edit', [UjiAirInternalController::class, 'edit'])->name('uji_air_internal.edit');
    Route::patch('/uji_air_internal/{id}', [UjiAirInternalController::class, 'update'])->name('uji_air_internal.update');
    Route::delete('/uji_air_internal/{id}', [UjiAirInternalController::class, 'destroy'])->name('uji_air_internal.destroy');
    Route::post('/uji_air_internal/{id}/approve', [UjiAirInternalController::class, 'approve'])->name('uji_air_internal.approve');
    Route::post('/uji_air_internal/{id}/revisi', [UjiAirInternalController::class, 'revisi'])->name('uji_air_internal.revisi');
    Route::get('/uji_air_internal/import', [UjiAirInternalController::class, 'showImportForm'])->name('uji_air_internal.importForm');
    Route::post('/uji_air_internal/import/file', [UjiAirInternalController::class, 'import'])->name('uji_air_internal.import');

    Route::get('/uji_air_eksternal', [UjiAirEksternalController::class, 'index'])->name('uji_air_eksternal.index');
    Route::get('/form_uji_air_eksternal', [UjiAirEksternalController::class, 'create'])->name('uji_air_eksternal.create');
    Route::post('/uji_air_eksternal', [UjiAirEksternalController::class, 'store'])->name('uji_air_eksternal.store');
    Route::resource('uji_air_eksternal', UjiAirEksternalController::class);
    Route::get('/uji_air_eksternal/{id}/edit', [UjiAirEksternalController::class, 'edit'])->name('uji_air_eksternal.edit');
    Route::patch('/uji_air_eksternal/{id}', [UjiAirEksternalController::class, 'update'])->name('uji_air_eksternal.update');
    Route::delete('/uji_air_eksternal/{id}', [UjiAirEksternalController::class, 'destroy'])->name('uji_air_eksternal.destroy');
    Route::post('/uji_air_eksternal/{id}/approve', [UjiAirEksternalController::class, 'approve'])->name('uji_air_eksternal.approve');
    Route::post('/uji_air_eksternal/{id}/revisi', [UjiAirEksternalController::class, 'revisi'])->name('uji_air_eksternal.revisi');
    Route::get('/uji_air_eksternal/import', [UjiAirEksternalController::class, 'showImportForm'])->name('uji_air_eksternal.importForm');
    Route::post('/uji_air_eksternal/import/file', [UjiAirEksternalController::class, 'import'])->name('uji_air_eksternal.import');

    Route::get('/berita_acara', [DataBeritaAcaraController::class, 'index'])->name('berita_acara.index');
    Route::get('/form_berita_acara', [DataBeritaAcaraController::class, 'create'])->name('berita_acara.create');
    Route::post('/berita_acara', [DataBeritaAcaraController::class, 'store'])->name('berita_acara.store');
    Route::get('/berita_acara/{id}/edit', [DataBeritaAcaraController::class, 'edit'])->name('berita_acara.edit');
    Route::patch('/berita_acara/{id}', [DataBeritaAcaraController::class, 'update'])->name('berita_acara.update');
    Route::delete('/berita_acara/{id}', [DataBeritaAcaraController::class, 'destroy'])->name('berita_acara.destroy');
    Route::post('/berita_acara/{id}/approve', [DataBeritaAcaraController::class, 'approve'])->name('berita_acara.approve');
    Route::post('/berita_acara/{id}/revisi', [DataBeritaAcaraController::class, 'revisi'])->name('berita_acara.revisi');
    Route::post('/berita_acara/download', [DataBeritaAcaraController::class, 'download'])->name('berita_acara.download');


    // Route::middleware(['auth'])->group(function () {
    Route::get('/data_user', [DataPenggunaController::class, 'index'])->name('data_user.index');
    Route::get('/data_user/{id}/edit', [DataPenggunaController::class, 'edit'])->name('data_user.edit');
    Route::put('/data_user/{id}', [DataPenggunaController::class, 'update'])->name('data_user.update');
    Route::delete('/data_user/{id}', [DataPenggunaController::class, 'destroy'])->name('data_user.destroy');
    // });



    Route::get('/maps', [MapsController::class, 'index'])->name('maps.index');

    // Route::get('/maps', function () {
    //     return view('maps');
    // });

    Route::get('/data_kawasan', function () {
        return view('data_kawasan');
    });


});

require __DIR__ . '/auth.php';


