<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, "showCorrectHomePage"]);

Route::get('/about',[PageController::class, "aboutPage"]);

Route::get('/login',[UserController::class, 'getLoginPage']);
Route::post('/login',[UserController::class, 'login']);

Route::get('/register', [UserController::class,'getRegisterPage']);
Route::post('/register', [UserController::class,'register']);


Route::post('/logout', [UserController::class, 'logout']);