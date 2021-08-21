<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [PostController::class, 'index'])->name('api.posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('api.posts.show');
Route::get('categories', [CategoryController::class, 'index'])->name('api.categories.index');
Route::get('users', [UserController::class, 'index'])->name('api.users.index');
