<?php

use App\User\Controllers\UserController;
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

Route::prefix('files')->name('files.')->group(function () {
    Route::get('/{link}', [FileController::class, 'showByLink']);
    Route::get('/downloadbylink/{link}', [FileController::class, 'downloadByLink']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('', [FileController::class, 'index']);
        Route::post('upload', [FileController::class, 'upload']);
        Route::post('upload/{folder_id}', [FileController::class, 'upload']);
        Route::put('{id}', [FileController::class, 'rename']);
        Route::delete('{id}', [FileController::class, 'delete']);
        Route::get('/download/{id}', [FileController::class, 'download']);
        Route::post('/download/generatelink/{id}', [FileController::class, 'generateLink']);
    });
});
