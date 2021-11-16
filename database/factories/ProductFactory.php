<?php

namespace Database\Factories;

use Faker\Core\Number;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product' => $this->faker->name(),
            'number' => $this->faker->numberBetween(1000,9999)."-".$this->faker->numberBetween(1000,9999),
            'price' => $this->faker->numberBetween(100,1000000),
        ];
    }
}
