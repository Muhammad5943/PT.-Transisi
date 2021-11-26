<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name;

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'logo' => $this->faker->imageUrl($width = 1024, $height = 720),
            'website' => $this->faker->url
        ];
    }
}
