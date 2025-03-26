<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('posts')->get();
        foreach($users as $user) {
            foreach($user->posts as $post) {
                $tags = Tag::pluck('id','name')->random(random_int(1,2))->toArray();
                $post->tags()->attach($tags);
            }
        }
    }
}
