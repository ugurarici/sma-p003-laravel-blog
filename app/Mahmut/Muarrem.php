<?php

namespace App\Mahmut;

use Illuminate\Support\Facades\DB;
use App\Models\Post;

class Muarrem
{
    protected $artist;

    public function __construct($artist)
    {
        $this->artist = $artist;
    }

    public function hello()
    {
        return "Selam";
    }

    public function singasong()
    {
        $posts = DB::table('posts')->get();
        $posts = Post::all();
        return $this->artist . " diyor ki: Kafamı çekmekten yazmazsam olmaz Muharreme bir martini verin";
    }
}
