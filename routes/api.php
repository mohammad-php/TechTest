<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('articles', ArticleController::class);
