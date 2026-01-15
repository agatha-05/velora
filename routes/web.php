<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProductDetail;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/search', [ProductController::class, 'search'])->name('search');

// Tambahkan Route Wishlist di sini
Route::view('/wishlist', 'wishlist')->name('wishlist');

Route::view('/cart', 'cart')->name('cart');

Route::get('/checkout', function () {
    return view('checkout'); // Pastikan file bernama checkout.blade.php
})->name('checkout');

Route::get('/invoice', function () {
    return view('invoice'); // Pastikan file bernama invoice.blade.php
})->name('invoice');