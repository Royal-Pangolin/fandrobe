<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/artistas', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artistas/{id}', [ArtistController::class, 'show'])->name('artists.show');

Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Auth
Route::get('/signin', fn() => view('auth.signin'))->name('signin');
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])->name('logout');
//Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
//Route::get('/reset-password/{token}', fn() => view('auth.reset-password'))->name('password.reset');
//Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');
//Route::get('/confirm-password', fn() => view('auth.confirm-password'))->name('password.confirm');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

// Carrito
Route::middleware('auth')->group(function () {

    // Carrito
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/añadir', [CartController::class, 'add'])->name('cart.add');
    Route::put('/carrito/actualizar/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Pedidos
    Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pedidos/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/pedidos', [OrderController::class, 'store'])->name('orders.store');

});