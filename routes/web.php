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
use App\Http\Controllers\landing\CartController;
use App\Http\Controllers\landing\HomeController;
use App\Http\Controllers\admin\CategorysProductController;
use App\Http\Controllers\admin\CategoryServicesController;
use App\Http\Controllers\admin\CarCatalogController;
use App\Http\Controllers\landing\ProductLandingController;
use App\Http\Controllers\landing\ServiceLandingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductLandingController::class, 'index'])->name('product');
Route::get('/product/{segment}', [ProductLandingController::class, 'show'])->name('product.details');
Route::get('/service', [ServiceLandingController::class, 'index'])->name('service');
Route::get('/service/{segment}', [ServiceLandingController::class, 'show'])->name('service.details');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart-order', [CartController::class, 'submitOrder'])->name('order.submit');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [LoginController::class, 'show'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.store');

// Protect dashboard, product, and service routes with 'auth' middleware
Route::middleware(['web', 'auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::get('/products/remove-image/{id}', [ProductController::class, 'removeImage'])->name('products.removeImage');
    Route::resource('services', ServiceController::class);
    Route::resource('sales', SalesController::class);
    Route::resource('team', TeamController::class);
    Route::resource('news', NewsController::class);
    Route::resource('testimoni', TestiController::class);
    Route::resource('message', MessageController::class);
    Route::resource('categorys', CategorysProductController::class);
    Route::resource('categoryservices', CategoryServicesController::class);
    Route::resource('carcatalog', CarCatalogController::class);
    Route::get('/carcatalog/remove-image/{id}', [CarCatalogController::class, 'removeImage'])->name('carcatalog.removeImage');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
