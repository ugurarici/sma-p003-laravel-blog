<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function setTags($tagsString)
    {
        if ($tagsString) {
            $tagsToAttach = array_unique(array_map('trim', explode(",", $tagsString)));
            foreach ($tagsToAttach as $tagName) {
                $tag = Tag::firstOrCreate([
                    'name' => $tagName
                ]);
                $this->tags()->attach($tag->id);
            }
        }
    }
}
