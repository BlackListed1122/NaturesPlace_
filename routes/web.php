<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;




Route::get('/', [HomeController::class, 'index'])->name('pages.index');
Route::resource('products', ProductController::class);
Route::get('/menu/products', [ProductController::class, 'menuProducts'])
    ->name('menu.products');
Route::resource('orders', OrderController::class);


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'checkout'])->name('cart.checkout');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Route::delete('/cart/delete', [CartController::class, 'removeAll'])->name('cart.removeAll');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/orders', [CartController::class, 'index'])->name('cart.index');

Route::get('/register', [RegisterController::class, 'show'])->name('signup.show');
Route::post('/register', [RegisterController::class, 'store'])->name('signup.store');


// Route::resource('record', RecordController::class);
Route::get('/record/create', [RecordController::class, 'create'])->name('record.create');
Route::post('/record/store', [RecordController::class, 'store'])->name('record.store');
Route::get('/record/{record}', [RecordController::class, 'show'])->name('record.show');
