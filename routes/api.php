<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\ActionLogController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('user/login',[AuthController::class,'login']);
// Route::post('user/register',[AuthController::class,'register']);

// // Posts
// Route::get('posts',[PostController::class,'posts']);
// Route::post('posts/search',[PostController::class,'postsSearch']);
// Route::post('post/detail',[PostController::class,'postDetail']);

// // Categories
// Route::get('category',[CategoryController::class,'category']);
// Route::post('category/search',[CategoryController::class,'categorySearch']);

// // ActionLogs
// Route::post('action/view',[ActionLogController::class,'viewCount']);

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

// Posts
Route::get('posts',[PostController::class,'posts']);
Route::post('posts/search',[PostController::class,'postsSearch']);
Route::post('post/detail',[PostController::class,'postDetail']);

// Categories
Route::get('category',[CategoryController::class,'category']);
Route::post('category/search',[CategoryController::class,'categorySearch']);

// ActionLogs
Route::post('action/view',[ActionLogController::class,'viewCount']);
