<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArenaController;
use App\Http\Controllers\QuadraController;
use App\Models\Arena;
use App\Http\Controllers\OwnersController;
use App\Http\Controllers\RegisterArenaOwnerController;

Route::get('/', function () {
    $arenas = Arena::all();
    return view('welcome', compact('arenas'));
});

Route::get('/registerArenaOwners', [RegisterArenaOwnerController::class, 'create'])
    ->name('register.arena.owners');

Route::post('/registerArenaOwners', [RegisterArenaOwnerController::class, 'store'])
    ->name('register.arena.owners.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        if (auth()->user()->type === 'owner') {
            return redirect()->route('owners.dashboard');
        }

        return view('dashboard');

    })->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

Route::middleware('auth')->group(function () {

    Route::get('/owners/create', [OwnersController::class, 'create'])
        ->name('owners.create');

    Route::post('/owners', [OwnersController::class, 'store'])
        ->name('owners.store');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/owners/dashboard', function () {
        return view('owners.dashboard');
    })->name('owners.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('arenas', ArenaController::class);
    Route::resource('quadras', QuadraController::class);
});

