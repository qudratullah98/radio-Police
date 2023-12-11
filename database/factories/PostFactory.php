<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'en_title' => $this->faker->sentence(),
            'da_title' => $this->faker->sentence(),
            'pa_title' => $this->faker->sentence(),
            'en_sub_title' => $this->faker->sentence(),
            'da_sub_title' => $this->faker->sentence(),
            'pa_sub_title' => $this->faker->sentence(),
            'en_description' => $this->faker->sentence(),
            'da_description' => $this->faker->sentence(),
            'pa_description' => $this->faker->sentence(),
            'status' => $this->faker->boolean(),
            // 'image' => $this->faker->name(),
            'created_by' => 1,

        ];
    }
}