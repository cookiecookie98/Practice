<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'equipment_name' => $this->faker->name(),
            'date_of_purchase' => now(),
            'other_common_field_1' => Str::random(25),
            'other_common_field_2' => Str::random(25),
            "user_id" => 12
        ];
    }
}
