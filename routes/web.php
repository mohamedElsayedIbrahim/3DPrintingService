<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'index'])->name('home');


// صفحة تسجيل الدخول
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

// صفحة التسجيل (اختياري)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware('auth')->group(function(){
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // صفحة تسجيل الخروج
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});