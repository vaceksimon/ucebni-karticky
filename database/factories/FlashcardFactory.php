<?php
/***********************************************************/
/*                                                         */
/* File: FlashcardFactory.php                              */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Factory for Flashcard model                */
/*                                                         */
/***********************************************************/
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class FlashcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $exercise = DB::table('exercises')->pluck('id');

        return [
            'exercise_id' => $this->faker->randomElement($exercise),
            'question'    => $this->faker->sentence(2),
            'answer'      => $this->faker->words(3, true)
        ];
    }
}
