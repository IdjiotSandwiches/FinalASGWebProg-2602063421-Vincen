<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth','pay'])
    ->prefix('payment')
    ->name('payment.')
    ->controller(PaymentController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/update', 'update')->name('update');
    });

Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')
        ->name('profile.')
        ->controller(ProfileController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::prefix('friend')
        ->name('friend.')
        ->controller(FriendController::class)
        ->group(function () {
            Route::post('/create/{id}', 'create')->name('create');
            Route::delete('/delete/{id}', 'delete')->name('delete');
        });
});