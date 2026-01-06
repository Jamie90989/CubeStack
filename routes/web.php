<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AlgorithmController;

Route::get('/', function () {
    return view('home');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/account', function () {
    return view('account');
})->middleware('auth');

Route::get('/algorithms', [AlgorithmController::class, 'index'])->name('algorithms.index');


Route::middleware('auth')->group(function () {
    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/algorithms/create', [AlgorithmController::class, 'create'])
        ->name('algorithms.create');

    Route::post('/algorithms', [AlgorithmController::class, 'store'])
        ->name('algorithms.store');
});





