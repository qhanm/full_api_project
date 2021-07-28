<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['request.api'])->group(function () {
    Route::post('user', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::put('user/{id}', [\App\Http\Controllers\AuthController::class, 'update']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});

Route::middleware(['request.api', 'auth:api'])->group(function () {
    Route::get('auth/me', [\App\Http\Controllers\AuthController::class, 'getMe']);

});
