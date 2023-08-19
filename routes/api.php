<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('transport-modes', TransportModeController::class);
    Route::get('transport-modes/{id}/submodes', [TransportSubmodeController::class, 'index']);
    Route::post('transport-modes/{id}/submodes', [TransportSubmodeController::class, 'store']);
    Route::get('transport-modes/{id}/submodes/{submode_id}', [TransportSubmodeController::class, 'show']);
    Route::put('transport-modes/{id}/submodes/{submode_id}', [TransportSubmodeController::class, 'update']);
    Route::delete('transport-modes/{id}/submodes/{submode_id}', [TransportSubmodeController::class, 'destroy']);
});
