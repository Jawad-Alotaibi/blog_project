<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\MustBeLoggedIn;

//User related routes
Route::get('/', [UserController::class, "showCorrectHomePage"]);
Route::get('/login',[UserController::class, 'getLoginPage'])->name('login')->middleware('guest');
Route::post('/login',[UserController::class, 'login'])->middleware('guest');
Route::get('/register', [UserController::class,'getRegisterPage'])->middleware('guest');
Route::post('/register', [UserController::class,'register'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');


//Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreatePostForm'])->middleware('mustBeLoggedIn');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost'])->middleware('mustBeLoggedIn');
Route::delete('/post/{post}', [PostController::class, 'delete']);

//Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
