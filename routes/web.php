<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/about', [IndexController::class, 'about']);
Route::get('/contact', [IndexController::class, 'contact']);

Route::resource('listings', ListingController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth');
Route::resource('listings', ListingController::class)
    ->except(['create', 'store', 'edit', 'update']);

Route::get('/login', [AuthController::class, 'create'])->name('login');
//                 'baths' => 'required|integer|min:0|max:20',
Route::post('/login', [AuthController::class, 'store'])->name('login.store');

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)
->only(['create', 'store']);

Route::prefix('realtor')
  ->name('realtor.')
  ->middleware('auth')
  ->group(function () {
    Route::resource('listing', RealtorListingController::class)
    ->only(['index', 'destroy']);
  });