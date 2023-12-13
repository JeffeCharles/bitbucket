<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Products;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->unique()->sentence(),
            'description' => $this->faker->text(),
            'augstums' => $this->faker->text(),
            'garums' => $this->faker->text(),
            'svars' => $this->faker->text()
        ];
    }
}
