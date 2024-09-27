<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('category', [CategoryController::class, 'index']);
    Route::post('category/store', [CategoryController::class, 'store']);
    Route::get('category/show/{category}', [CategoryController::class, 'show']);
    Route::any('category/update/{category}', [CategoryController::class, 'update']);
    
    Route::get('category/delete/{category}', [CategoryController::class, 'delete']);
});
