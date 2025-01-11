<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\TeamController;
use App\Http\Controllers\admin\TestiController;
use App\Http\Controllers\landing\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Protect dashboard, product, and service routes with 'auth' middleware
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::get('/products/remove-image/{id}', [ProductController::class, 'removeImage'])->name('products.removeImage');
    Route::resource('services', ServiceController::class);
    Route::resource('sales', SalesController::class);
    Route::resource('team', TeamController::class);
    Route::resource('news', NewsController::class);
    Route::resource('testimoni', TestiController::class);
    Route::resource('message', MessageController::class);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
