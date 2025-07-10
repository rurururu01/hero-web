<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('index');
})->name('home');

// User Management Route
Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/daftar-data', [App\Http\Controllers\HomeController::class, 'daftarData'])->name('daftar-data');
Route::get('/daftardata', [App\Http\Controllers\HomeController::class, 'daftarData'])->name('daftardata');

// Route untuk halaman tambah data
Route::get('/tambahdata', function () {
    return view('tambahdata');
})->name('tambahdata');

// Route untuk menyimpan data
Route::post('/tambahdata', [App\Http\Controllers\HomeController::class, 'store'])->name('tambahdata.store');

// Route untuk edit data
Route::get('/editdata/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('editdata');
Route::put('/editdata/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('editdata.update');

// Route untuk hapus data
Route::delete('/hapusdata/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('hapusdata');

// Route untuk halaman grafik
Route::get('/grafik', [App\Http\Controllers\HomeController::class, 'grafik'])->name('grafik');

// Route untuk halaman resto
Route::get('/resto/{slug}', [App\Http\Controllers\HomeController::class, 'resto'])->name('resto');

// Route untuk halaman checkout
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'processOrder'])->name('checkout.process');
Route::post('/checkout/stock', [App\Http\Controllers\CheckoutController::class, 'getItemStock'])->name('checkout.stock');

// Authentication Routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');