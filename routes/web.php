<?php

use App\Http\Controllers\JobOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobOrderToolController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('main-dashboard', ['title' => 'Dashboard', 'subtitle' => 'Ringkasan laporan riksa uji PT. Asteria Riksa Indonesia']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tools Route
    Route::middleware(['auth', 'role:owner|admin'])->group(function () {
    Route::resource('tools', ToolController::class);
});


Route::middleware(['auth', 'role:owner|petugas'])->group(function () {
    Route::resource('job_orders', JobOrderController::class);
    Route::patch('/job-order-tools/{jobOrderTool}/selesai', [JobOrderToolController::class, 'setSelesai'])
    ->name('job-order-tools.selesai');

    Route::patch('/job-order-tools/{jobOrderTool}/belum', [JobOrderToolController::class, 'setBelum'])
    ->name('job-order-tools.belum');
});

});

require __DIR__.'/auth.php';
