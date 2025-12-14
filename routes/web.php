<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardEskalatorController;
use App\Http\Controllers\DashboardIPKController;
use App\Http\Controllers\DashboardPAPAController;
use App\Http\Controllers\DashboardPTPController;
use App\Http\Controllers\DashboardPUBTController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\JobOrderToolController;
use App\Http\Controllers\FormKpBejanaTekanController;
use App\Http\Controllers\FormKpElevatorController;
use App\Http\Controllers\FormKpEskalatorController;
use App\Http\Controllers\FormKpInstalasiFireAlarmController;
use App\Http\Controllers\FormKpInstalasiFireHydrantController;
use App\Http\Controllers\FormKpKatelUapController;
use App\Http\Controllers\FormKpPesawatTenagaProduksiController;
use App\Http\Controllers\FormKpScissorLiftController;
use App\Http\Controllers\FormKpScrewCompressorController;
use App\Http\Controllers\FormKpTangkiTimbunController;
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
    Route::prefix('form_kp/pubt')->name('form_kp.pubt.')->middleware(['role:petugas|admin|superAdmin|penyusunLHP'])->group(function () {
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

        // CRUD Tangki Timbun
        Route::prefix('tangki_timbun')->name('tangki_timbun.')->group(function () {
            Route::get('/', [FormKpTangkiTimbunController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpTangkiTimbunController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpTangkiTimbunController::class, 'store'])->name('store');
            Route::get('/{formKpTangkiTimbun}', [FormKpTangkiTimbunController::class, 'show'])->name('show');
            Route::get('/{formKpTangkiTimbun}/edit', [FormKpTangkiTimbunController::class, 'edit'])->name('edit');
            Route::put('/{formKpTangkiTimbun}', [FormKpTangkiTimbunController::class, 'update'])->name('update');
        });
    });

    // Rute Form KP PTP: Semua Role
    Route::prefix('form_kp/ptp')->name('form_kp.ptp.')->middleware(['role:petugas|admin|superAdmin|penyusunLHP'])->group(function () {
        // Dashboard PTP
        Route::get('/', [DashboardPTPController::class, 'index'])->name('index');

        // CRUD Pesawat Tenaga Produksi
        Route::prefix('pesawat_tenaga_produksi')->name('pesawat_tenaga_produksi.')->group(function () {
            Route::get('/', [FormKpPesawatTenagaProduksiController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpPesawatTenagaProduksiController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpPesawatTenagaProduksiController::class, 'store'])->name('store');
            Route::get('/{formKpPesawatTenagaProduksi}', [FormKpPesawatTenagaProduksiController::class, 'show'])->name('show');
            Route::get('/{formKpPesawatTenagaProduksi}/edit', [FormKpPesawatTenagaProduksiController::class, 'edit'])->name('edit');
            Route::put('/{formKpPesawatTenagaProduksi}', [FormKpPesawatTenagaProduksiController::class, 'update'])->name('update');
        });
    });


    // Rute Form KP PAPA: Semua Role
    Route::prefix('form_kp/papa')->name('form_kp.papa.')->middleware(['role:petugas|admin|superAdmin|penyusunLHP'])->group(function () {
        // Dashboard PUBT
        Route::get('/', [DashboardPAPAController::class, 'index'])->name('index');

        // CRUD Scissor Lift
        Route::prefix('scissor_lift')->name('scissor_lift.')->group(function () {
            Route::get('/', [FormKpScissorLiftController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpScissorLiftController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpScissorLiftController::class, 'store'])->name('store');
            Route::get('/{formKpScissorLift}', [FormKpScissorLiftController::class, 'show'])->name('show');
            Route::get('/{formKpScissorLift}/edit', [FormKpScissorLiftController::class, 'edit'])->name('edit');
            Route::put('/{formKpScissorLift}', [FormKpScissorLiftController::class, 'update'])->name('update');
        });
    });

    // Rute Form KP Eskalator: Semua Role
    Route::prefix('form_kp/eskalator')->name('form_kp.eskalator.')->middleware(['role:petugas|admin|superAdmin|penyusunLHP'])->group(function () {
        // Dashboard Eskalator
        Route::get('/', [DashboardEskalatorController::class, 'index'])->name('index');

        // CRUD Eskalator
        Route::prefix('eskalator')->name('eskalator.')->group(function () {
            Route::get('/', [FormKpEskalatorController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpEskalatorController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpEskalatorController::class, 'store'])->name('store');
            Route::get('/{formKpEskalator}', [FormKpEskalatorController::class, 'show'])->name('show');
            Route::get('/{formKpEskalator}/edit', [FormKpEskalatorController::class, 'edit'])->name('edit');
            Route::put('/{formKpEskalator}', [FormKpEskalatorController::class, 'update'])->name('update');
        });

        // CRUD Elevator
        Route::prefix('elevator')->name('elevator.')->group(function () {
            Route::get('/', [FormKpElevatorController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpElevatorController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpElevatorController::class, 'store'])->name('store');
            Route::get('/{formKpElevator}', [FormKpElevatorController::class, 'show'])->name('show');
            Route::get('/{formKpElevator}/edit', [FormKpElevatorController::class, 'edit'])->name('edit');
            Route::put('/{formKpElevator}', [FormKpElevatorController::class, 'update'])->name('update');
        });
    });
    // Rute Form KP IPK: Semua Role
    Route::prefix('form_kp/ipk')->name('form_kp.ipk.')->middleware(['role:petugas|admin|superAdmin|penyusunLHP'])->group(function () {
        // Dashboard IPK
        Route::get('/', [DashboardIPKController::class, 'index'])->name('index');

        // CRUD IPK
        Route::prefix('instalasi_fire_hydrant')->name('instalasi_fire_hydrant.')->group(function () {
            Route::get('/', [FormKpInstalasiFireHydrantController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpInstalasiFireHydrantController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpInstalasiFireHydrantController::class, 'store'])->name('store');
            Route::get('/{formKpInstalasiFireHydrant}', [FormKpInstalasiFireHydrantController::class, 'show'])->name('show');
            Route::get('/{formKpInstalasiFireHydrant}/edit', [FormKpInstalasiFireHydrantController::class, 'edit'])->name('edit');
            Route::put('/{formKpInstalasiFireHydrant}', [FormKpInstalasiFireHydrantController::class, 'update'])->name('update');
        });

        Route::prefix('instalasi_fire_alarm')->name('instalasi_fire_alarm.')->group(function () {
            Route::get('/', [FormKpInstalasiFireAlarmController::class, 'index'])->name('index');
            Route::get('/{jobOrderTool}/create', [FormKpInstalasiFireAlarmController::class, 'create'])->name('create');
            Route::post('/{jobOrderTool}', [FormKpInstalasiFireAlarmController::class, 'store'])->name('store');
            Route::get('/{formKpInstalasiFireHydrant}', [FormKpInstalasiFireAlarmController::class, 'show'])->name('show');
            Route::get('/{formKpInstalasiFireHydrant}/edit', [FormKpInstalasiFireAlarmController::class, 'edit'])->name('edit');
            Route::put('/{formKpInstalasiFireHydrant}', [FormKpInstalasiFireAlarmController::class, 'update'])->name('update');
        });
    });
});

require __DIR__ . '/auth.php';
