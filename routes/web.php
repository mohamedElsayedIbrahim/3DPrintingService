<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::get('/register', [AuthController::class,'showRegister']);
Route::post('/register', [AuthController::class,'register']);
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class,'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class,'store'])->name('orders.store');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::post('/admin/orders/{id}/update', [AdminController::class,'updateOrderStatus']);
});
