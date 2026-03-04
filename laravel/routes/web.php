<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Admin Panel
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::put('/users/{user}/ban', 'ban')->name('ban');
            Route::put('/users/{user}/unban', 'unban')->name('unban');
        });
    });

    // User Space
    Route::prefix('user')->name('user.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

        // Colocation
        Route::controller(ColocationController::class)->group(function () {
            Route::post('/colocation', 'store')->name('colocation.store');
            Route::post('/colocation/{colocation}/leave', 'leave')->name('leave');
            Route::post('/colocation/{colocation}/cancel', 'cancel')->name('cancel');
        });

        // Invitations
        Route::controller(InvitationController::class)->prefix('invitations')->name('invitation.')->group(function () {
            Route::post('/send', 'send')->name('send');
            Route::post('/{id}/accept', 'accept')->name('accept');
            Route::post('/{id}/refuse', 'refuse')->name('refuse');
        });

        // Categories
        Route::resource('categories', CategoryController::class)->only(['store', 'destroy']);

        Route::controller(ExpenseController::class)->prefix('expenses')->name('expenses.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{expense}', 'destroy')->name('destroy');
            Route::post('/{expense}/payment', 'payment')->name('payment');
        });
    });
});
