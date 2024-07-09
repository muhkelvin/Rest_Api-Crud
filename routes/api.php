<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

//Route::apiResource('posts', App\Http\Controllers\PostController::class);



Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);


Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});


//Route::post('token',\App\Http\Controllers\TokenGenerator::class);
