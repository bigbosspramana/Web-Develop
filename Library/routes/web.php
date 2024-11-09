<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});


// Rute untuk halaman form create
Route::get('/items/create', [DatabaseController::class, 'create'])->name('items.create');

// Rute untuk menyimpan data item baru
Route::post('/items', [DatabaseController::class, 'store'])->name('items.store');

// Route untuk menampilkan item dari DatabaseController
Route::get('/items', [DatabaseController::class, 'index'])->name('index');
