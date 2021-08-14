<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();

        foreach (\App\Models\Category::all() as $category) {
            $category->followers()->attach(
                \App\Models\User::inRandomOrder()->take(rand(1, 6))->pluck('id')
            );
        }

        \App\Models\Post::factory(50)->create();
        \App\Models\Tag::factory(20)->create();

        foreach (\App\Models\Post::all() as $post) {
            $post->tags()->attach(
                \App\Models\Tag::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        }
    }
}
