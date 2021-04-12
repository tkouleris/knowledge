<?php

use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\KnowledgeController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\UrlController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login',[AuthController::class,'login']);

Route::group(['middleware' => ['jwtauth']], function() {

    Route::prefix('knowledge')->group(function () {
        Route::get('all', [KnowledgeController::class, 'index']);
        Route::post('{id}/url', [UrlController::class, 'create']);
        Route::get('{id}/url/{url_id}', [UrlController::class, 'show']);
        Route::put('{id}/url/{url_id}', [UrlController::class, 'update']);
        Route::delete('{id}/url/{url_id}', [UrlController::class, 'delete']);
        Route::post('{id}/video', [VideoController::class, 'create']);
        Route::delete('{id}/video/{video_id}', [VideoController::class, 'delete']);
        Route::get('{id}/video/{video_id}', [VideoController::class, 'show']);
        Route::put('{id}/video/{video_id}', [VideoController::class, 'update']);

        Route::post('{id}/tag', [TagController::class, 'tagCreateOrUpdate']);
        Route::delete('{id}/tag/{tag_id}', [TagController::class, 'tagDeleteFromKnowledge']);

        Route::post('create', [KnowledgeController::class, 'create']);
        Route::get('{id}', [KnowledgeController::class, 'show']);
        Route::post('{id}', [KnowledgeController::class, 'update']);
        Route::delete('{id}', [KnowledgeController::class, 'delete']);

    });

    Route::post('user/update', [UserController::class, 'update']);
    Route::post('user/avatar',[ImageController::class, 'ImageUpload']);

    Route::prefix('tag')->group(function () {
        Route::post('/create', [TagController::class, 'create']);
        Route::delete('/{id}', [TagController::class, 'delete']);
        Route::get('/{id}', [TagController::class, 'show']);
        Route::put('/{id}', [TagController::class, 'update']);
    });

});
