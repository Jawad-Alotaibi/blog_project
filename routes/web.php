<?php

use App\Events\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
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
Route::get('/post/{post}', [PostController::class, 'showSinglePost'])->middleware('mustBeLoggedIn');
Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware(['can:delete,post', 'mustBeLoggedIn']);
Route::get('/post/{post}/edit', [PostController::class, 'showEditPostForm'])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, 'update'])->middleware('can:update,post');
Route::get('/search/{term}', [PostController::class, 'search']);



//Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profilePosts'])->middleware('mustBeLoggedIn');
Route::get('/profile/{user:username}/manage-avatar', [UserController::class, 'showManageAvatarPage'])->middleware('mustBeLoggedIn');
Route::post('/profile/manage-avatar', [UserController::class, 'uploadAvatar'])->middleware('mustBeLoggedIn');


//Admin related routes
Route::get('/admins-only', function (){
    return 'only admins can see this page';
})->middleware('can:visitAdminPages');


//Follow related routes
Route::post('/create-follow/{user:username}',[FollowController::class, 'createFollow'])->middleware('mustBeLoggedIn');
Route::delete('/remove-follow/{user:username}',[FollowController::class, 'removeFollow'])->middleware('mustBeLoggedIn');
Route::get('profile/{user:username}/followers/', [UserController::class, 'profileFollowers'])->middleware('mustBeLoggedIn');
Route::get('profile/{user:username}/following/', [UserController::class, 'profileFollowing'])->middleware('mustBeLoggedIn');

// Chat route
Route::post('/send-chat-message', function (Request $request) {
    $formFields = $request->validate([
        'textvalue' => 'required'
    ]);

    if (! trim(strip_tags($formFields['textvalue']))) {
        return response()->noContent();
    }

    broadcast(new ChatMessage([
        'username'  => auth()->user()->username,
        'textvalue' => strip_tags($formFields['textvalue']),
        'avatar' => auth()->user()->avatar,
    ]))->toOthers();

    return response()->noContent();
})->middleware('mustBeLoggedIn');
