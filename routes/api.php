<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Category\CategoryResourceController;
use App\Http\Controllers\Post\PostResourceController;
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

// Auth Router
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => 'api'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::group(['middleware' => 'api'], function () {
    // Category Resource
    Route::group(['prefix' => 'category'], function () {
        Route::resource('category', CategoryResourceController::class);
    });

    // Post Resource
    Route::group(['prefix' => 'post'], function () {
        Route::resource('post', PostResourceController::class);
    });
});

// Contact Router
Route::post('send-contact', [ContactController::class, 'sendContact']);


