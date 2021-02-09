<?php

use App\Http\Controllers\API\KnowledgeController;
use App\Http\Controllers\API\UrlController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('knowledge/{id}/url', [UrlController::class, 'create']);
Route::delete('knowledge/{id}/url/{url_id}', [UrlController::class, 'delete']);
Route::post('knowledge/create', [KnowledgeController::class, 'create']);
Route::get('knowledge/{id}', [KnowledgeController::class, 'show']);
Route::post('knowledge/{id}', [KnowledgeController::class, 'update']);
Route::delete('knowledge/{id}', [KnowledgeController::class, 'delete']);
