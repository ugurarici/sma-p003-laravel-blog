<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $postsQuery = Post::with(['user', 'category'])->latest();
        if ($request->query('category')) $postsQuery->where('category_id', (int)$request->query('category'));
        if ($request->query('user')) $postsQuery->where('user_id', (int)$request->query('user'));
        $posts = $postsQuery->paginate(10)->withQueryString();
        return $posts;
    }

    public function show($post)
    {
        return Post::with(['user', 'category'])->findOrFail($post);
    }
}
