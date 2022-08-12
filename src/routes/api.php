<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClintController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\StatusController;
// use App\Http\Controllers\ImageController;

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

Route::post('/user/login', [LoginController::class, 'login']);
Route::post('/user/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
});

Route::prefix('clint')->group(function () {
    Route::post('/store', [ClintController::class, 'store']);
    Route::get('/index', [ClintController::class, 'index']);
    Route::delete('/{id}', [ClintController::class, 'delete']);
    Route::patch('/{clint}', [ClintController::class, 'update']);
    
});

Route::prefix('car')->group(function () {
    Route::post('/store', [CarController::class, 'store']);
    Route::get('/index', [CarController::class, 'index']);
    Route::delete('/{id}', [CarController::class, 'delete']);
    Route::patch('/{car}', [CarController::class, 'update']);
    
});

Route::prefix('status')->group(function () {
    Route::get('/index', [StatusController::class, 'index']);
    
});

// Route::prefix('file')->group(function () {
//     Route::get('/index', [ImageController::class, 'index']);
//     Route::post('/store', [ImageController::class, 'store']);
// });