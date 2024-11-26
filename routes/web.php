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
use App\Http\Controllers\GeneratePDFController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('data_passive.index');
    // Route::get('/data_passive', [DataPassiveController::class, 'index'])->name('data_passive.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/form_data_passive', [DataPassiveController::class, 'create'])->name('data_passive.create');
    // Route::post('/data_passive', [DataPassiveController::class, 'store'])->name('data_passive.store');
    // Route::resource('data_passive', DataPassiveController::class);

    // Route::get('/form_data_klhk', [DataKLHKController::class, 'create'])->name('data_klhk.create');
    // Route::post('/data_klhk', [DataKLHKController::class, 'store'])->name('data_klhk.store');
    // Route::resource('data_klhk', DataKLHKController::class);

    Route::get('/generate-pdf', [GeneratePDFController::class, 'generatePDF'])->name('generatePDF.index');

    // DATA KUALITAS UDARA
    Route::get('/form_data_passive', [DataPassiveController::class, 'create'])->name('data_passive.create');
    Route::get('/data_passive', [DataPassiveController::class, 'index'])->name('data_passive.index');
    Route::post('/data_passive', [DataPassiveController::class, 'store'])->name('data_passive.store');
    Route::resource('data_passive', DataPassiveController::class);
    Route::get('/data_passive/{id}/edit', [DataPassiveController::class, 'edit'])->name('data_passive.edit');
    Route::patch('/data_passive/{id}', [DataPassiveController::class, 'update'])->name('data_passive.update');
    Route::delete('/data_passive/{id}', [DataPassiveController::class, 'destroy'])->name('data_passive.destroy');
    Route::post('/data_passive/{id}/approve', [DataPassiveController::class, 'approve'])->name('data_passive.approve');
    Route::post('/data_passive/{id}/revisi', [DataPassiveController::class, 'revisi'])->name('data_passive.revisi');

    // Route::get('/data_spkua', [DataSPKUAController::class, 'index'])->name('data_spkua.index');
    // Route::get('/form_data_spkua', [DataSPKUAController::class, 'create'])->name('data_spkua.create');
    // Route::post('/data_spkua', [DataSPKUAController::class, 'store'])->name('data_spkua.store');
    // Route::resource('data_spkua', DataSPKUAController::class);
    // Route::get('/data_spkua/{id}/edit', [DataSPKUAController::class, 'edit'])->name('data_spkua.edit');
    // Route::patch('/data_spkua/{id}', [DataSPKUAController::class, 'update'])->name('data_spkua.update');
    // Route::delete('/data_spkua/{id}', [DataSPKUAController::class, 'destroy'])->name('data_spkua.destroy');

    Route::get('/form_data_spkua', [DataSPKUAController::class, 'create'])->name('data_spkua.create');
    Route::post('/data_spkua', [DataSPKUAController::class, 'store'])->name('data_spkua.store');
    Route::resource('data_spkua', DataSPKUAController::class);
    Route::get('/data_spkua/{id}/edit', [DataSPKUAController::class, 'edit'])->name('data_spkua.edit');
    Route::patch('/data_spkua/{id}', [DataSPKUAController::class, 'update'])->name('data_spkua.update');
    Route::delete('/data_spkua/{id}', [DataSPKUAController::class, 'destroy'])->name('data_spkua.destroy');
    Route::post('/data_spkua/{id}/verify', [DataSPKUAController::class, 'verify'])->name('data_spkua.verify');
    // Route::post('/data_spkua/batch-approve', [DataSPKUAController::class, 'batchApprove'])->name('data_spkua.batchApprove');
    Route::post('/data_spkua/{id}/approve', [DataSPKUAController::class, 'approve'])->name('data_spkua.approve');
    Route::post('/data_spkua/{id}/revisi', [DataSPKUAController::class, 'revisi'])->name('data_spkua.revisi');

    Route::get('/form_data_partikulat', [DataPartikulatController::class, 'create'])->name('data_partikulat.create');
    Route::post('/data_partikulat', [DataPartikulatController::class, 'store'])->name('data_partikulat.store');
    Route::resource('data_partikulat', DataPartikulatController::class);
    Route::get('/data_partikulat/{id}/edit', [DataPartikulatController::class, 'edit'])->name('data_partikulat.edit');
    Route::patch('/data_partikulat/{id}', [DataPartikulatController::class, 'update'])->name('data_partikulat.update');
    Route::delete('/data_partikulat/{id}', [DataPartikulatController::class, 'destroy'])->name('data_partikulat.destroy');
    Route::post('/data-partikulat/{id}/verify', [DataPartikulatController::class, 'verify'])->name('data_partikulat.verify');
    Route::post('/data_partikulat/{id}/approve', [DataPartikulatController::class, 'approve'])->name('data_partikulat.approve');
    Route::post('/data_partikulat/{id}/revisi', [DataPartikulatController::class, 'revisi'])->name('data_partikulat.revisi');
    // Route::post('/data_partikulat/batch-approve', [DataPartikulatController::class, 'batchApprove'])->name('data_partikulat.batchApprove');


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

    Route::get('/form_data_klhk', [DataKLHKController::class, 'create'])->name('data_klhk.create');
    Route::post('/data_klhk', [DataKLHKController::class, 'store'])->name('data_klhk.store');
    Route::resource('data_klhk', DataKLHKController::class);
    Route::get('/data_klhk/{id}/edit', [DataKLHKController::class, 'edit'])->name('data_klhk.edit');
    Route::patch('/data_klhk/{id}', [DataKLHKController::class, 'update'])->name('data_klhk.update');
    Route::delete('/data_klhk/{id}', [DataKLHKController::class, 'destroy'])->name('data_klhk.destroy');
    Route::post('/data_klhk/{id}/approve', [DataKLHKController::class, 'approve'])->name('data_klhk.approve');
    Route::post('/data_klhk/{id}/revisi', [DataKLHKController::class, 'revisi'])->name('data_klhk.revisi');

    // DATA KUALITAS AIR
    Route::get('/uji_air_internal', [UjiAirInternalController::class, 'index'])->name('uji_air_internal.index');
    Route::get('/form_uji_air_internal', [UjiAirInternalController::class, 'create'])->name('uji_air_internal.create');
    Route::post('/uji_air_internal', [UjiAirInternalController::class, 'store'])->name('uji_air_internal.store');
    Route::resource('uji_air_internal', UjiAirInternalController::class);
    Route::get('/uji_air_internal/{id}/edit', [UjiAirInternalController::class, 'edit'])->name('uji_air_internal.edit');
    Route::patch('/uji_air_internal/{id}', [UjiAirInternalController::class, 'update'])->name('uji_air_internal.update');
    Route::delete('/uji_air_internal/{id}', [UjiAirInternalController::class, 'destroy'])->name('uji_air_internal.destroy');
    Route::post('/uji_air_internal/{id}/approve', [UjiAirInternalController::class, 'approve'])->name('uji_air_internal.approve');
    Route::post('/uji_air_internal/{id}/revisi', [UjiAirInternalController::class, 'revisi'])->name('uji_air_internal.revisi');

    Route::get('/uji_air_eksternal', [UjiAirEksternalController::class, 'index'])->name('uji_air_eksternal.index');
    Route::get('/form_uji_air_eksternal', [UjiAirEksternalController::class, 'create'])->name('uji_air_eksternal.create');
    Route::post('/uji_air_eksternal', [UjiAirEksternalController::class, 'store'])->name('uji_air_eksternal.store');
    Route::resource('uji_air_eksternal', UjiAirEksternalController::class);
    Route::get('/uji_air_eksternal/{id}/edit', [UjiAirEksternalController::class, 'edit'])->name('uji_air_eksternal.edit');
    Route::patch('/uji_air_eksternal/{id}', [UjiAirEksternalController::class, 'update'])->name('uji_air_eksternal.update');
    Route::delete('/uji_air_eksternal/{id}', [UjiAirEksternalController::class, 'destroy'])->name('uji_air_eksternal.destroy');
    Route::post('/uji_air_eksternal/{id}/approve', [UjiAirEksternalController::class, 'approve'])->name('uji_air_eksternal.approve');
    Route::post('/uji_air_eksternal/{id}/revisi', [UjiAirEksternalController::class, 'revisi'])->name('uji_air_eksternal.revisi');

    Route::get('/berita_acara', [DataBeritaAcaraController::class, 'index'])->name('berita_acara.index');
    Route::get('/form_berita_acara', [DataBeritaAcaraController::class, 'create'])->name('berita_acara.create');
    Route::post('/berita_acara', [DataBeritaAcaraController::class, 'store'])->name('berita_acara.store');
    Route::get('/berita_acara/{id}/edit', [DataBeritaAcaraController::class, 'edit'])->name('berita_acara.edit');
    // Route::put('/berita_acara/{id}', [DataBeritaAcaraController::class, 'update'])->name('berita_acara.update');
    Route::put('/berita_acara/{id}', [DataBeritaAcaraController::class, 'update'])->name('berita_acara.update');
    Route::delete('/berita_acara/{id}', [DataBeritaAcaraController::class, 'destroy'])->name('berita_acara.destroy');
    Route::post('/berita_acara/download', [DataBeritaAcaraController::class, 'download'])->name('berita_acara.download');


    // Route::resource('/berita_acara', DataBeritaAcaraController::class); // bisa dihapus jika semua rute sudah didefinisikan




    Route::get('/', function () {
        return view('dashboard');
    });

    // Route::get('/editberita', function () {
    //     return view('edit/berita_acara');
    // });

    Route::get('/data_spkua', function () {
        return view('data_spkua');
    });
    Route::get('/form_data_spkua', function () {
        return view('form_data_spkua');
    });

    Route::get('/data_air', function () {
        return view('data_air');
    });

    Route::get('/edit_data_partikulat', function () {
        return view('edit_data_partikulat');
    });
    Route::get('/form_data_air', function () {
        return view('form_data_air');
    });

    // Route::get('/data_klhk', function () {
    //     return view('data_klhk');
    // });

    // Route::get('/form_data_klhk', function () {
    //     return view('form_data_klhk');
    // });

    // Route::get('/data_partikulat', function () {
    //     return view('data_partikulat');
    // });

    // Route::get('/form_data_partikulat', function () {
    //     return view('form_data_partikulat');
    // });

    Route::get('/maps', function () {
        return view('maps');
    });

    // Route::get('/form_berita_acara', function () {
    //     return view('form_berita_acara');
    // });

    // Route::get('/berita_acara', function () {
    //     return view('berita_acara');
    // });

});

require __DIR__ . '/auth.php';
