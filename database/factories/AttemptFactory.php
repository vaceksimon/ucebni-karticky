<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class AttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $student         = DB::table('users')->select('id')->where('type', 'student')->pluck('id');
        $exercise        = DB::table('exercises')->pluck('id');
        $exercise_id     = $this->faker->randomElement($exercise);

        $answers_count   = DB::table('exercises')
                            ->rightJoin('flashcards', 'exercises.id', '=', 'flashcards.exercise_id')
                            ->where('exercise_id', $exercise_id)
                            ->count();
        $correct_answers = $answers_count - rand(0, $answers_count);
        $wrong_answers   = $answers_count - $correct_answers;

        return [
            'exercise_id'            => $exercise_id,
            'user_id'                => $this->faker->randomElement($student),
            'spend_time'             => $this->faker->time(),
            'correct_answers_number' => $correct_answers,
            'wrong_answers_number'   => $wrong_answers
        ];
    }
}
