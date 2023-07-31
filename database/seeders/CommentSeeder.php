<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $comments = Comment::factory()->count(5)->create();
        foreach ($comments as $comment) {
            $comment->created_at = now();
            $comment->updated_at = now();
            $comment->save();
        }
    }
}
