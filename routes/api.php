<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
*/




Route::middleware('auth:api')->get('/user', function (Request $request) {
    // return $request->user();
    // Route::post('storeBlog', 'Api\BlogController@store');
    Route::post('/user/register', [App\Http\Controllers\Api\UserController::class, 'registerApi']);
});

Route::post('/user/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/user/login', [App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('/user/social/login', [App\Http\Controllers\Api\UserController::class, 'socialLogin']);
Route::get('/user/details/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::post('/user/update', [App\Http\Controllers\Api\UserController::class, 'update']);
Route::post('/user/change-password', [App\Http\Controllers\Api\UserController::class, 'changePassword']);

// ----------------Banner--------------------

Route::get('/banner', [App\Http\Controllers\Api\BannerController::class, 'index']);


// ----------------UserInterest--------------------

Route::get('/user/interest', [App\Http\Controllers\Api\UserInterestController::class, 'index']);
Route::post('/user/interest/store', [App\Http\Controllers\Api\UserInterestController::class, 'store']);
// Route::post('/user/interest/update/{id}', [App\Http\Controllers\Api\UserInterestController::class, 'update']);
Route::post('/user/interest/delete/{id}', [App\Http\Controllers\Api\UserInterestController::class, 'destroy']);

// ------------------Forum-------------------------

Route::get('/forum/list', [App\Http\Controllers\Api\ForumController::class, 'index']);
Route::post('/forum/store', [App\Http\Controllers\Api\ForumController::class, 'store']);
Route::post('/forum/details/{id}', [App\Http\Controllers\Api\ForumController::class, 'show']);
Route::post('/forum/update/{id}', [App\Http\Controllers\Api\ForumController::class, 'update']);
Route::post('/forum/delete/{id}', [App\Http\Controllers\Api\ForumController::class, 'destroy']);

// ------------------Forum Comment------------------------

Route::get('/forum/comment/list', [App\Http\Controllers\Api\ForumCommentController::class, 'index']);
Route::post('/forum/comment/store', [App\Http\Controllers\Api\ForumCommentController::class, 'store']);
Route::get('/forum/comment/details/{id}', [App\Http\Controllers\Api\ForumCommentController::class, 'show']);
Route::post('/forum/comment/update/{id}', [App\Http\Controllers\Api\ForumCommentController::class, 'update']);
Route::post('/forum/comment/delete/{id}', [App\Http\Controllers\Api\ForumCommentController::class, 'destroy']);

// ------------------Team-------------------------

Route::get('/team/list/{userId}', [App\Http\Controllers\Api\TeamController::class, 'index']);
Route::post('/team/store', [App\Http\Controllers\Api\TeamController::class, 'store']);
Route::get('/team/details/{id}', [App\Http\Controllers\Api\ForumController::class, 'show']);
Route::post('/team/update/{id}', [App\Http\Controllers\Api\TeamController::class, 'update']);
Route::post('/team/delete/{id}', [App\Http\Controllers\Api\TeamController::class, 'destroy']);

// ------------------Event-------------------------

Route::get('/event/list', [App\Http\Controllers\Api\EventController::class, 'index']);