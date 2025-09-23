<?php

use App\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->name('home');
Route::get('/category', \App\Livewire\Product\CategoryComponent::class)->name('category');
Route::get('/product', \App\Livewire\Product\ProductComponent::class)->name('product');
