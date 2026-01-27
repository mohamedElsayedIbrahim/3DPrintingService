<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'index'])->name('home');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
