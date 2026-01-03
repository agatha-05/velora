<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProductDetail;
use App\Http\Controllers\ProductController;



Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/search', [ProductController::class, 'search'])->name('search');

