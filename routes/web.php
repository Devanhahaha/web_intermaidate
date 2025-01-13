<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/login', function () { 
    return view('login');
})->name('login');

Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/admin/users', function () {
    return view('user');
})->name('users');

// Route::get('home', function () {
//     return view('home');
// })->name('home');

Route::post('/login/process', [LoginController::class, 'checkAuth'])->name('login.process');
Route::post('/register/process', [LoginController::class, 'store'])->name('register.process');
Route::get('/logout/process', [LoginController::class, 'logout'])->name('logout');



Route::post('/forgot-password/process', [LoginController::class, 'SendEmail'])->name('forgot.password');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/product', [ProductController::class, 'index'])->name('product');
Route::post('/bayar', [HomeController::class, 'pay'])->name('bayar');
Route::get('/bayar/sukses/{snap_token}', [HomeController::class, 'pay_success'])->name('bayar_sukses');
Route::get('/home', [HomeController::class, 'index'])->name('home');