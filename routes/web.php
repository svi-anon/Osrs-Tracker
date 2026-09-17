<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankItemController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('characters', CharacterController::class);

    Route::post('/characters/{character}/bank', [BankItemController::class, 'store'])
        ->name('bank.store');

    Route::put('/bank/{bankItem}', [BankItemController::class, 'update'])
        ->name('bank.update');

    Route::delete('/bank/{bankItem}', [BankItemController::class, 'destroy'])
        ->name('bank.destroy');

    Route::get('/admin', [AdminController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';