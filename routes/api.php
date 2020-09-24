<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot', [AuthController::class, 'forgot']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::prefix('assets')->group(function () {
    Route::get('/', [AssetController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('create', [AssetController::class, 'store']);
        Route::put('{asset}', [AssetController::class, 'update'])->middleware('can:update,asset');
        Route::delete('{asset}', [AssetController::class, 'destroy'])->middleware('can:delete,asset');
    });
    Route::get('{asset}', [AssetController::class, 'show']);
});
