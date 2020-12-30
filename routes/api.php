<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AvatarController;

use Illuminate\Support\Facades\Log;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'images'], function ($router) {
    Route::post('/upload', [ImageController::class, 'storeImage']);
    Route::post('/load/for-user', [ImageController::class, 'getImagesOfSpecificUser']);
    Route::post('/load/main-page', [ImageController::class, 'getImagesFromFollowedUsers']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function ($router) {
    Route::post('/information', [UserController::class, 'getInformation']);
    Route::post('/search', [UserController::class, 'searchUsers']);
});

Route::group(['middleware' => 'auth:api'], function ($router) {
    Route::post('/follow', [FollowController::class, 'follow']);
    Route::post('/unfollow', [FollowController::class, 'unfollow']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'avatar'], function ($router) {
    Route::post('/upload', [AvatarController::class, 'storeAvatar']);
});