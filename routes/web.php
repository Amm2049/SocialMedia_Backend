<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminListController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TrendingPostsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Admin Profile
    Route::get('dashboard',[ProfileController::class,'index'])->name('admin#profile');
    Route::post('profile/update',[ProfileController::class,'updateProfile'])->name('admin#update');
    Route::get('profile/passwordPage',[ProfileController::class,'updatePasswordPage'])->name('admin#updatePasswordPage');
    Route::post('profile/updatePassword',[ProfileController::class,'updatePassword'])->name('admin#updatePassword');

    // Admins List Page
    Route::get('admin/list',[AdminListController::class,'index'])->name('admin#list');
    Route::get('admin/delete',[AdminListController::class,'delete'])->name('admin#delete');

    // Admin Categories
    Route::get('admin/category',[CategoriesController::class,'index'])->name('admin#category');
    Route::post('admin/category/create',[CategoriesController::class,'createCategory'])->name('admin#createCategory');
    Route::get('admin/category/delete',[CategoriesController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::post('admin/category/search',[CategoriesController::class,'searchCategory'])->name('admin#searchCategory');
    Route::get('admin/category/edit/{id}',[CategoriesController::class,'editCategory'])->name('admin#editCategory');
    Route::post('admin/category/update/{id}',[CategoriesController::class,'updateCategory'])->name('admin#updateCategory');

    // Admin Posts
    Route::get('admin/post',[PostsController::class,'index'])->name('admin#post');
    Route::post('admin/post/create',[PostsController::class,'create'])->name('admin#createPost');
    Route::get('admin/post/delete',[PostsController::class,'delete'])->name('admin#deletePost');
    Route::get('admin/post/edit/{id}',[PostsController::class,'edit'])->name('admin#editPost');
    Route::post('admin/post/update/{id}',[PostsController::class,'update'])->name('admin#updatePost');

    // Admin Trending Posts
    Route::get('admin/trendingPosts',[TrendingPostsController::class,'index'])->name('admin#trendingPosts');
    Route::get('admin/trendingPosts/edit/{id}',[TrendingPostsController::class,'edit'])->name('admin#trendingPostsEdit');
});
