<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [UserController::class, 'show']);
    Route::post('/profile/update', [UserController::class, 'update']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/post/store', [PostController::class, 'store']);
    Route::put('/post/{id}/update', [PostController::class, 'update']);
    Route::get('/post/{slug}', [PostController::class, 'show']);
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy']);

    Route::post('/post/{slug}/comment', [CommentController::class, 'store']);
    Route::delete('/post/{id}/comment/delete', [CommentController::class, 'destroy']);

    Route::post('/category/store', [CategoryController::class, 'store']);
});
