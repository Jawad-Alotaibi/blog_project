<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


//User related routes
Route::get('/', [UserController::class, "showCorrectHomePage"]);
Route::get('/login',[UserController::class, 'getLoginPage']);
Route::post('/login',[UserController::class, 'login']);
Route::get('/register', [UserController::class,'getRegisterPage']);
Route::post('/register', [UserController::class,'register']);
Route::post('/logout', [UserController::class, 'logout']);


//Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreatePostForm']);
Route::post('/create-post', [PostController::class, 'storeNewPost']);