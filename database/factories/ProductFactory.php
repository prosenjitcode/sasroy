<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id'=> $this->faker->numberBetween(1,10),
            'title'=>$this->faker->title,
            'autor'=>$this->faker->name(),
            'language'=>'Bengali',
            'publishDate'=>$this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
            'description'=>$this->faker->paragraph,
            'imageUrl'=>$this->faker->imageUrl($width = 640, $height = 480),
            'price'=>$this->faker->numberBetween(100,600),
            'discount'=>$this->faker->numberBetween(5,30),
            'pages'=>$this->faker->numberBetween(100,1200),
            'stock'=>$this->faker->numberBetween(1,10),
        ];
    }
}
