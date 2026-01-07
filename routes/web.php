<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AlgorithmController;
use Illuminate\Container\Attributes\Auth;

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
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/algorithms/create', [AlgorithmController::class, 'create'])->name('algorithms.create');

    Route::post('/algorithms', [AlgorithmController::class, 'store'])->name('algorithms.store');

    Route::get('/algorithms/{algorithm}/edit', [AlgorithmController::class, 'edit'])->name('algorithms.edit');

    Route::put('/algorithms/{algorithm}', [AlgorithmController::class, 'update'])->name('algorithms.update');

    Route::delete('/algorithms/{algorithm}', [AlgorithmController::class, 'destroy'])->name('algorithms.destroy');

    Route::get('/categories/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Security check
    Route::get('/security-check', [AuthController::class, 'securityCheck'])->name('users.security.check');
    Route::post('/security-check', [AuthController::class, 'verifySecurity'])->name('users.security.verify');

    // Edit account
    Route::get('/users/{user}/edit', [AuthController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AuthController::class, 'update'])->name('users.update');

});


Route::middleware('auth')->post('/user/toggle-hide-standard', [AuthController::class, 'toggleHideStandard'])
    ->name('user.toggleHideStandard');

