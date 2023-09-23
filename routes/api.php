<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/authors', AuthorController::class);
Route::resource('/posts', BlogPostController::class);
Route::get('/published-posts', [BlogPostController::class, 'fetchPublishedPosts']);
Route::get('/published-posts-unsafe', [BlogPostController::class, 'fetchPublishedPostsUnsafe']);
Route::get('/published-posts-inefficient', [BlogPostController::class, 'fetchPublishedPostsInefficient']);
