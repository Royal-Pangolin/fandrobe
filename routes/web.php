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

Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/añadir', [CartController::class, 'add'])->name('cart.add');
Route::put('/carrito/actualizar/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');