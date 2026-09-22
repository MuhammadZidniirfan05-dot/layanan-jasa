<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/layanan/{category}', [CategoryController::class, 'show'])->name('category.show');