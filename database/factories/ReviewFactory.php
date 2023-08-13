<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id'=>$this->faker->numberBetween(1,50),
            'user_id'=>User::all()->random()->id,
            'review'=>$this->faker->paragraph,
            'star'=>$this->faker->numberBetween(1,5),
        ];
    }
}
