<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPUBTController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\JobOrderToolController;
use App\Http\Controllers\FormKpBejanaTekanController;
use App\Http\Controllers\FormKpKatelUapController;
use App\Http\Controllers\FormKpScrewCompressorController;
use App\Http\Controllers\RiksaUjiController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    // Rute Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Daftar Alat: Hanya SuperAdmin & Admin
    Route::middleware(['role:superAdmin|admin'])->group(function () {
        // endpoint AJAX untuk filter sub-jenis
        Route::get('tools/sub-jenis/{jenis}', [ToolController::class, 'subJenis'])
            ->name('tools.subjenis');

        // Tools Resource (CRUD)
        Route::resource('tools', ToolController::class);
    });

    // Rute Job Order: Semua Role
    Route::middleware(['role:superAdmin|admin|petugas|penyusunLHP'])->group(function () {
        // Job Orders Resource (CRUD)
        Route::resource('job_orders', JobOrderController::class);
        Route::patch('/job-order-tools/{jobOrderTool}/selesai', [JobOrderToolController::class, 'setSelesai'])
        ->name('job-order-tools.selesai');
        Route::patch('/job-order-tools/{jobOrderTool}/belum', [JobOrderToolController::class, 'setBelum'])
        ->name('job-order-tools.belum');
    });

    // User Management: Hanya superAdmin
    Route::middleware(['role:superAdmin'])->group(function () {
        Route::get('/superadmin', [SuperAdminController::class, 'index'])
        ->name('superadmin.index');
        Route::patch('/superadmin/update-role/{id}', [SuperAdminController::class, 'updateRole'])
            ->name('superadmin.updateRole');
        Route::delete('/superadmin/delete-user/{id}', [SuperAdminController::class, 'destroyUser'])
            ->name('superadmin.destroyUser');
    });

    // Rute Riksa Uji
    Route::get('/riksa_uji', [RiksaUjiController::class, 'index'])->name('riksa_uji.index');

    // Rute Form KP Bejana Tekan: Semua Role
    Route::prefix('form_kp/pubt')->name('form_kp.pubt.')->middleware(['role:petugas|admin|superAdmin'])->group(function () {
        // Dashboard PUBT
        Route::get('/', [DashboardPUBTController::class, 'index'])->name('index');

        // CRUD Bejana Tekan
        Route::prefix('bejana_tekan')->name('bejana_tekan.')->group(function () {
            Route::get('/', [FormKpBejanaTekanController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpBejanaTekanController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpBejanaTekanController::class, 'store'])->name('store');
            Route::get('/{formKpBejanaTekan}', [FormKpBejanaTekanController::class, 'show'])->name('show');
            Route::get('/{formKpBejanaTekan}/edit', [FormKpBejanaTekanController::class, 'edit'])->name('edit');
            Route::put('/{formKpBejanaTekan}', [FormKpBejanaTekanController::class, 'update'])->name('update');
        });

        // CRUD Katel Uap
        Route::prefix('katel_uap')->name('katel_uap.')->group(function () {
            Route::get('/', [FormKpKatelUapController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpKatelUapController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpKatelUapController::class, 'store'])->name('store');
            Route::get('/{formKpKatelUap}', [FormKpKatelUapController::class, 'show'])->name('show');
            Route::get('/{formKpKatelUap}/edit', [FormKpKatelUapController::class, 'edit'])->name('edit');
            Route::put('/{formKpKatelUap}', [FormKpKatelUapController::class, 'update'])->name('update');
        });

        // CRUD Screw Compressor
        Route::prefix('screw_compressor')->name('screw_compressor.')->group(function () {
            Route::get('/', [FormKpScrewCompressorController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpScrewCompressorController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpScrewCompressorController::class, 'store'])->name('store');
            Route::get('/{formKpScrewCompressor}', [FormKpScrewCompressorController::class, 'show'])->name('show');
            Route::get('/{formKpScrewCompressor}/edit', [FormKpScrewCompressorController::class, 'edit'])->name('edit');
            Route::put('/{formKpScrewCompressor}', [FormKpScrewCompressorController::class, 'update'])->name('update');
        });
    });
});

require __DIR__.'/auth.php';
