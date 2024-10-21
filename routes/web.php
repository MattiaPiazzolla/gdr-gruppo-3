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

// Rotte per i tipi
Route::resource('types', TypeController::class);
Route::post('/types/{id}/soft-delete', [TypeController::class, 'softDelete'])->name('types.softDelete');
Route::post('/types/{id}/restore', [TypeController::class, 'restore'])->name('types.restore');
Route::delete('/types/{id}/force-delete', [TypeController::class, 'forceDelete'])->name('types.forceDelete');



// Rotte per gli items
Route::resource('items', ItemController::class);
Route::post('/items/{id}/soft-delete', [ItemController::class, 'softDelete'])->name('items.softDelete');
Route::post('/items/{id}/restore', [ItemController::class, 'restore'])->name('items.restore');
Route::delete('/items/{id}/force-delete', [ItemController::class, 'forceDelete'])->name('items.forceDelete');