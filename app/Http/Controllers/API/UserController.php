<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class UserController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('email'),
                AllowedFilter::exact('is_admin'),
                AllowedFilter::partial('name'),
            ])
            ->defaultSort('id')
            ->allowedSorts('id', 'name', 'is_admin', 'created_at', 'updated_at')
            ->allowedIncludes(['postsCount', 'followedCategories', 'followedCategoriesCount'])
            ->paginate()
            ->appends(request()->query());
        return $users;
    }
}
