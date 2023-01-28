<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statuses = [
            'pending',
            'in_developing',
            'on_testing',
            'on_checking',
            'done'
        ];
        return [
            'user_id' => rand(1, 4),
            'title' => fake()->realText(rand(10, 15)),
            'body' => fake()->realText(rand(100, 150)),
            'status' => rand(1, 5),
            'created_at' => fake()->dateTimeBetween('-60 days', '-30 days'),
            'updated_at' => fake()->dateTimeBetween('-20 days', '-1 days'),
        ];
    }
}
