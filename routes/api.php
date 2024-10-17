<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CharacterApiController;
use App\Http\Controllers\Api\ItemApiController;
use App\Http\Controllers\Api\TypeApiController;

use function PHPSTORM_META\type;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/characters', [CharacterApiController::class, 'index'])->name('get_characters');
Route::get('/items', [ItemApiController::class, 'index'])->name('get_items');
Route::get('/types', [TypeApiController::class, 'index'])->name('get_types');