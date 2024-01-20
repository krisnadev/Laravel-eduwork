<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;



// Rute untuk menampilkan halaman login
Route::get('/', function () {
    return view('login');
});

// Rute untuk menampilkan formulir login dan mengelola proses login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth', [LoginController::class, 'login'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute sumber daya (CRUD) untuk pengelolaan data registrasi
Route::resource('register', RegisterController::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
])->middleware('auth');
