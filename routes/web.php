<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArenaController;
use App\Http\Controllers\QuadraController;
use App\Models\Arena;

Route::get('/', function () {

    $arenas = Arena::all();
    return view('welcome', compact('arenas'));
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

Route::middleware(['auth', 'funcionario'])->group(function () {

    Route::get('/funcionario', function () {
        return view('funcionario.dashboard');
    });
});     

Route::middleware(['auth', 'cliente'])->group(function () {

    Route::get('/cliente', function () {
        return view('cliente.dashboard');
    });
});

Route::middleware(['auth'])->group(function () {

    Route::resource('arenas', ArenaController::class);
    Route::resource('quadras', QuadraController::class);
});
