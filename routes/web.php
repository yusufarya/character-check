<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterCheckController;
use App\Http\Controllers\CharacterFrequencyController;
use App\Http\Controllers\LoginController;

Route::middleware(['auth-check'])->group(function () {
    Route::get('/', function() {
        return view('welcome');
    });

    Route::get('/character-list', [CharacterCheckController::class, 'index'])->name('character-list');
    Route::get('/create-character', [CharacterCheckController::class, 'create'])->name('create-character');
    Route::post('/character-check', [CharacterCheckController::class, 'store'])->name('character-check');
    Route::get('/edit-character/{id}', [CharacterCheckController::class, 'edit'])->name('edit-character');
    Route::get('/show-character/{id}', [CharacterCheckController::class, 'show'])->name('show-character');
    Route::put('/character-update/{id}', [CharacterCheckController::class, 'update'])->name('character-update');
    Route::post('/character-delete', [CharacterCheckController::class, 'destroy'])->name('character-delete');
    Route::get('/generate-frequency/{id}', [CharacterFrequencyController::class, 'generate'])->name('generate-frequency');

    Route::get('/character-frequency-list', [CharacterFrequencyController::class, 'index'])->name('character-frequency-list');
    Route::get('/create-character-frequency', [CharacterFrequencyController::class, 'create'])->name('create-character-frequency');
    Route::post('/character-frequency-check', [CharacterFrequencyController::class, 'check'])->name('character-frequency-check');
    Route::post('/character-frequency-store', [CharacterFrequencyController::class, 'store'])->name('character-frequency-store');
    Route::get('/character-frequency-show/{id}', [CharacterFrequencyController::class, 'show'])->name('character-frequency-show');
    Route::get('/edit-character-frequency/{id}', [CharacterFrequencyController::class, 'edit'])->name('edit-character-frequency');
    Route::put('/character-frequency-update/{id}', [CharacterFrequencyController::class, 'update'])->name('character-frequency-update');
    Route::post('/character-frequency-delete', [CharacterFrequencyController::class, 'destroy'])->name('character-frequency-delete');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['authenticated'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login-process');
});

