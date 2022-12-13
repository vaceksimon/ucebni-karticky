<?php
/***********************
 * Author: Tomas Bartu *
 * Login: xbartu11     *
 ***********************/
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teacher = DB::table('users')->select('id')->where('account_type', 'teacher')->pluck('id');
        return [
            'author'      => $this->faker->randomElement($teacher),
            'name'        => $this->faker->words(2, true),
            'description' => $this->faker->sentence(4),
            'topic'       => $this->faker->word(),
            'visibility'  => $this->faker->randomElement(['public', 'private']),
            'show_timer'  => $this->faker->randomElement([true, false])
        ];
    }
}
