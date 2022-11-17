<?php

namespace Database\Seeders;

use App\Models\Attempt;
use Illuminate\Database\Seeder;

class AttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attempt::factory()->create([
            'exercise_id'            => 1,
            'user_id'                => 2,
            'spend_time'             => '00:42:00',
            'correct_answers_number' => 2,
            'wrong_answers_number'   => 1
        ]);
        Attempt::factory()->times(100)->create();
    }
}
