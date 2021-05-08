<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthenticationController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthenticationController::class, 'logout']);

        Route::get('users', [UserController::class, 'users_logged_time']);
    });
});


