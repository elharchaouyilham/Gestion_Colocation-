<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {});
Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');
Route::put('dashboard/{user}/unban', [AdminController::class, 'unban'])
    ->name('admin.unban');
Route::put('dashboard/{user}/ban', [AdminController::class, 'ban'])
    ->name('admin.ban');



Route::middleware(['auth'])->prefix('user')->group(function () {});

    Route::get('/userr', [UserController::class, 'index'])
        ->name('user.dashboard');

    Route::get('/colocation', [UserController::class, 'store'])
        ->name('user.colocation.store');

    Route::POST('/invitation/{id}/accept', [UserController::class, 'accept'])
        ->name('user.invitation.accept');

    Route::POST('/invitation/{id}/refuse', [UserController::class, 'refuse'])
        ->name('user.invitation.refuse');

    Route::get('/leave', [UserController::class, 'leave'])
        ->name('user.leave');













Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
