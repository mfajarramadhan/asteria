<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProfileController;

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
    Route::middleware(['auth', 'role:admin|owner|petugas'])->group(function () {
    Route::resource('tools', ToolController::class);
});
});

require __DIR__.'/auth.php';
