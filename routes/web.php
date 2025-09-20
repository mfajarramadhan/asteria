<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobOrderToolController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Rute Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Daftar Alat: Hanya Role SuperAdmin & Admin
Route::middleware(['auth', 'role:superAdmin|admin'])->group(function () {
    // endpoint AJAX untuk filter sub-jenis
    Route::get('tools/sub-jenis/{jenis}', [ToolController::class, 'subJenis'])
        ->name('tools.subjenis');
    // Tools Resource (CRUD)
    Route::resource('tools', ToolController::class);
});

// Rute Daftar Alat: Semua Role
Route::middleware(['auth', 'role:superAdmin|admin|petugas|penyusunLHP'])->group(function () {
    // Job Orders Resource (CRUD)
    Route::resource('job_orders', JobOrderController::class);
    Route::patch('/job-order-tools/{jobOrderTool}/selesai', [JobOrderToolController::class, 'setSelesai'])
    ->name('job-order-tools.selesai');
    Route::patch('/job-order-tools/{jobOrderTool}/belum', [JobOrderToolController::class, 'setBelum'])
    ->name('job-order-tools.belum');
});

// User Management: hanya superAdmin
Route::middleware(['role:superAdmin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])
    ->name('superadmin.index');
    Route::patch('/superadmin/update-role/{id}', [SuperAdminController::class, 'updateRole'])
        ->name('superadmin.updateRole');
    Route::delete('/superadmin/delete-user/{id}', [SuperAdminController::class, 'destroyUser'])
        ->name('superadmin.destroyUser');
});

});

require __DIR__.'/auth.php';
