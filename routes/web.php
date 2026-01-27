<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/
Route::prefix('product')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    // UUID pattern validation for product ID
    Route::get('/{product}', [ProductController::class, 'show'])
        ->name('show')
        ->where('product', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
});

/*
|--------------------------------------------------------------------------
| Student Information Route
|--------------------------------------------------------------------------
*/
Route::get('/sinhvien/{name?}/{studentId?}', [PageController::class, 'sinhvien'])
    ->name('sinhvien')
    ->where([
        'name' => '[a-zA-Z\s\-]+',           // Only allow letters, spaces, and hyphens
        'studentId' => '[0-9]+',              // Only allow numeric student IDs
    ]);

/*
|--------------------------------------------------------------------------
| Chess Board (Banco) Route
|--------------------------------------------------------------------------
*/
Route::get('/banco/{n}', [PageController::class, 'banco'])
    ->name('banco')
    ->where('n', '[0-9]+');                   // Only allow positive integers

/*
|--------------------------------------------------------------------------
| 404 Fallback Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
