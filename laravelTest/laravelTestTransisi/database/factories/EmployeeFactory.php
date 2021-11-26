<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
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
            'company_id' => Company::inRandomOrder()->limit(1)->pluck('id')->first(),
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail()
        ];
    }
}
