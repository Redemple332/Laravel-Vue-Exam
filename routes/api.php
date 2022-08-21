<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\LoginController;

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

/*Public API */


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('users', [UserController::class, 'index']);
    Route::prefix('/user')->group( function () {
        Route::post('store', [UserController::class, 'store']);
        Route::get('/edit/{id}', [UserController::class, 'edit']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });


    Route::get('roles', [RoleController::class, 'index']);
    Route::prefix('/role')->group( function () {
        Route::post('/store', [RoleController::class, 'store']);
        Route::get('/edit/{id}', [RoleController::class, 'edit']);
        Route::put('/{id}', [RoleController::class, 'update']);
        Route::delete('/{id}', [RoleController::class, 'destroy']);
    });

});



