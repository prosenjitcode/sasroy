<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::all()->random()->id,
            'name'=>$this->faker->name,
            'phone_no'=>$this->faker->phoneNumber,
            'address'=>$this->faker->address,
            'city'=>$this->faker->city,
            'pincode'=>$this->faker->postcode,
            'state'=>$this->faker->state,
            'area'=>$this->faker->streetName
        ];
    }
}
