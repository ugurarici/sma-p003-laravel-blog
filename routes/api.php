<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', function () {
    //  return a list of posts as JSON
    return Post::all();
});

Route::get('posts/{post}', function ($post) {
    //  return a Post's detail
    $post = Post::with(['user', 'category'])->findOrFail($post);
    return $post;
});

Route::get('categories', function () {
    return Category::with(['posts.count'])->get();
});

Route::get('users', function () {
    return User::with(['posts.count'])->get();
});
