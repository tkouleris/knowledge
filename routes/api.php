<?php

use App\Http\Controllers\API\KnowledgeController;
use App\Http\Controllers\API\UrlController;
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


Route::prefix('knowledge')->group(function () {
    Route::post('{id}/url', [UrlController::class, 'create']);
    Route::get('{id}/url/{url_id}', [UrlController::class, 'show']);
    Route::put('{id}/url/{url_id}', [UrlController::class, 'update']);
    Route::delete('{id}/url/{url_id}', [UrlController::class, 'delete']);
    Route::post('{id}/video', [VideoController::class, 'create']);
    Route::delete('{id}/video/{video_id}', [VideoController::class, 'delete']);
    Route::get('{id}/video/{video_id}', [VideoController::class, 'show']);
    Route::put('{id}/video/{video_id}', [VideoController::class, 'update']);
    Route::post('create', [KnowledgeController::class, 'create']);
    Route::get('{id}', [KnowledgeController::class, 'show']);
    Route::post('{id}', [KnowledgeController::class, 'update']);
    Route::delete('{id}', [KnowledgeController::class, 'delete']);
});
//Route::post('knowledge/{id}/url', [UrlController::class, 'create']);
//Route::get('knowledge/{id}/url/{url_id}', [UrlController::class, 'show']);
//Route::put('knowledge/{id}/url/{url_id}', [UrlController::class, 'update']);
//Route::delete('knowledge/{id}/url/{url_id}', [UrlController::class, 'delete']);
//Route::post('knowledge/{id}/video', [VideoController::class, 'create']);
//Route::delete('knowledge/{id}/video/{video_id}', [VideoController::class, 'delete']);
//Route::get('knowledge/{id}/video/{video_id}', [VideoController::class, 'show']);
//Route::put('knowledge/{id}/video/{video_id}', [VideoController::class, 'update']);
//Route::post('knowledge/create', [KnowledgeController::class, 'create']);
//Route::get('knowledge/{id}', [KnowledgeController::class, 'show']);
//Route::post('knowledge/{id}', [KnowledgeController::class, 'update']);
//Route::delete('knowledge/{id}', [KnowledgeController::class, 'delete']);
