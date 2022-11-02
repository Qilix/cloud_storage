<?php

use App\User\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\File\Controllers\FileController;
use App\Folder\Controllers\FolderController;


Route::prefix('users')->name('users.')->group(function () {

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function() {
        Route::post('logout', [UserController::class, 'logout']);
        Route::get('', [UserController::class, 'get']);
    });
});

Route::prefix('folders')->name('folders.')->group(function () {
    Route::middleware('auth:sanctum')->group(function() {
        Route::get('', [FolderController::class, 'get']);
        Route::get('/{folder_id}',[FolderController::class, 'getDetail']);
        Route::post('create', [FolderController::class, 'create']);
    });
});
Route::get('/files/download/{id}', [FileController::class, 'download']);
Route::prefix('files')->name('files.')->middleware('auth:sanctum')->group(function () {
    Route::get('', [FileController::class, 'index']);
    Route::post('upload', [FileController::class, 'upload']);
    Route::post('upload/{folder_id}', [FileController::class, 'upload']);
    Route::put( '{id}', [FileController::class, 'rename']);
    Route::delete('{id}', [FileController::class, 'delete']);

});
