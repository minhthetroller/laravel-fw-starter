<?php

use App\Http\Controllers\AuthController;
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
| Authentication Routes
|--------------------------------------------------------------------------
*/
// Guest-only routes (redirect to home if already logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'signIn']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout requires authentication
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Age Verification Routes
|--------------------------------------------------------------------------
*/
Route::get('/age-check', [PageController::class, 'showAgeCheck'])->name('age-check');
Route::post('/age-check', [PageController::class, 'verifyAge'])->name('age-check.verify');
Route::get('/age-denied/{years?}', [PageController::class, 'ageDenied'])->name('age-denied');

/*
|--------------------------------------------------------------------------
| Product Routes (Age Restricted)
|--------------------------------------------------------------------------
*/
Route::middleware('age.check')->prefix('product')->name('products.')->group(function () {
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
