<?php

use App\User\Controllers\UserController;
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

Route::prefix('users')->name('users.')->group(function () {

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function() {
        Route::post('logout', [UserController::class, 'logout']);
        Route::get('', [UserController::class, 'get']);
    });
});