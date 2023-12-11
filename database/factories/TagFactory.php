<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'en_name' => $this->faker->name(),
            'da_name' => $this->faker->name(),
            'pa_name' => $this->faker->name(),
            'status' => $this->faker->boolean(),
            'created_by' => 1,
        ];
    }
}