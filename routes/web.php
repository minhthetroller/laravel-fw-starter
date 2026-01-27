<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
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
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// AJAX endpoint for username availability check
Route::post('/check-username', [AuthController::class, 'checkUsername'])->name('check.username');

/*
|--------------------------------------------------------------------------
| 404 Fallback Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
