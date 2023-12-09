<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\User;

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
    public function definition(): array
    {
        return [
            'user_id' => User::all()->all()->random()->id,
            'name' => $this->faker->unique()->sentance(),
            'description' => $this->faker->text(),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high'])
        ];
    }
}
