<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = QueryBuilder::for(Post::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('category_id'),
                AllowedFilter::exact('user_id'),
                AllowedFilter::partial('title'),
                AllowedFilter::partial('content'),
            ])
            ->defaultSort('-created_at')
            ->allowedSorts('id', 'created_at', 'updated_at')
            ->allowedIncludes(['user', 'category'])
            ->paginate()
            ->appends(request()->query());
        return $posts;
    }

    public function show($post)
    {
        return Post::with(['user', 'category'])->findOrFail($post);
    }
}
