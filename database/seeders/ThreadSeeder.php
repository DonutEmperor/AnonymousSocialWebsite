<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Thread;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $threads = Thread::factory()->count(5)->create();
        foreach ($threads as $thread) {
            $thread->created_at = now();
            $thread->updated_at = now();
            $thread->save();
        }
    }
}
