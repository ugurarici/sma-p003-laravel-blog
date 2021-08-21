<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::partial('name'),
            ])
            ->defaultSort('name')
            ->allowedSorts('id', 'name', 'created_at', 'updated_at')
            ->allowedIncludes(['postsCount'])
            ->paginate()
            ->appends(request()->query());
        return $categories;
    }
}
