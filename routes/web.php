<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Rotte per i personaggi
Route::resource('characters', CharacterController::class);
Route::post('/characters/{id}/soft-delete', [CharacterController::class, 'softDelete'])->name('characters.softDelete');
Route::post('/characters/{id}/restore', [CharacterController::class, 'restore'])->name('characters.restore');
Route::delete('/characters/{id}/force-delete', [CharacterController::class, 'forceDelete'])->name('characters.forceDelete');

// Rotte per gli oggetti e i tipi
Route::resource('items', ItemController::class);
Route::resource('types', TypeController::class);