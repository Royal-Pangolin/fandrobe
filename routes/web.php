<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminArtistController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


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
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
//Route::get('/reset-password/{token}', fn() => view('auth.reset-password'))->name('password.reset');
//Route::get('/confirm-password', fn() => view('auth.confirm-password'))->name('password.confirm');

// Profile
Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware(['auth', 'verified']);

// Carrito y funciones autenticadas
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

    // Favoritos
    Route::post('/favoritos/producto', [FavoriteController::class, 'toggleProduct'])->name('favorites.toggleProduct');
    Route::post('/favoritos/artista', [FavoriteController::class, 'toggleArtist'])->name('favorites.toggleArtist');
    Route::get('/favoritos/productos', [FavoriteController::class, 'favoriteProducts'])->name('favorites.index');
    Route::get('/favoritos/artistas', [FavoriteController::class, 'followedArtists'])->name('followings.index');

});

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('pedidos', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('productos', AdminProductController::class);
    Route::resource('artistas', AdminArtistController::class);
    Route::resource('usuarios', AdminUserController::class)->only(['index', 'show']);
});