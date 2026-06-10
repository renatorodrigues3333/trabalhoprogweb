<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArenaController;
use App\Http\Controllers\QuadraController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'proprietario'])->group(function () {

    Route::get('/proprietario', function () {
        return view('proprietario.dashboard');
    });
});
Route::middleware(['auth'])->group(function () {

    Route::resource('arenas', ArenaController::class);
    Route::resource('quadras', QuadraController::class);
});
