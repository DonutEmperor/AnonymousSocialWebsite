<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'thread_id' => $this->faker->numberBetween(1, 5),
            'body' => $this->faker->paragraph,
            'upvotes' => $this->faker->numberBetween(0, 100),
            'downvotes' => $this->faker->numberBetween(0, 100),
            'report_count' => $this->faker->numberBetween(0, 10),
        ];
    }
}
