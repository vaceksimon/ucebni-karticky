<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teacher = DB::table('users')->select('id')->where('type', 'teacher')->pluck('id');

        return [
            'owner' => $this->faker->randomElement($teacher),
            'name' => $this->faker->words(5, true),
            'description' => $this->faker->sentence(4),
            'photo' => $this->faker->imageUrl(640, 480, 'abstract', true),
            'type' => $this->faker->randomElement(['teachers', 'students'])
        ];
    }
}
