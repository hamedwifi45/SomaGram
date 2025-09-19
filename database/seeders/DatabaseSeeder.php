<?php

namespace Database\Seeders;

use App\Models\imagepost;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->has(
                Post::factory()
                    ->count(3)
                    // سيتم تنفيذ هذا الكود بعد إنشاء كل منشور
                    ->afterCreating(function (Post $post) {
                        // هنا يتم إنشاء عدد عشوائي من الصور لكل منشور
                        imagepost::factory()->count(random_int(1, 6))->create([
                            'post_id' => $post->id,
                        ]);
                    })
            )
            ->create();
    }
}