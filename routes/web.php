<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/artistas', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artistas/{id}', [ArtistController::class, 'show'])->name('artists.show');

Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Auth
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');
//Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
//Route::get('/reset-password/{token}', fn() => view('auth.reset-password'))->name('password.reset');
//Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');
//Route::get('/confirm-password', fn() => view('auth.confirm-password'))->name('password.confirm');
Route::post('/logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/añadir', [CartController::class, 'add'])->name('cart.add');
Route::put('/carrito/actualizar/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');
