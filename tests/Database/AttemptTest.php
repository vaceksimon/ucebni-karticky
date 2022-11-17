<?php

namespace Tests\Database;

use Tests\TestCase;
use App\Models\Attempt;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttemptTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_attempt_exists()
    {
        $attempt = Attempt::factory()->create();

        $this->assertModelExists($attempt);
    }

    public function test_model_attemp_delete()
    {
        $attempt = Attempt::factory()->create();

        $attempt->delete();

        $this->assertModelMissing($attempt);
    }

    public function test_model_attempt_duplication()
    {
        $attempt1 = Attempt::make([
            'exercise_id'            => 1,
            'user_id'                => 2,
            'spend_time'             => '00:42:00',
            'correct_answers_number' => 2,
            'wrong_answers_number'   => 1
        ]);

        $attempt2 = Attempt::make([
            'exercise_id'            => 2,
            'user_id'                => 2,
            'spend_time'             => '00:42:00',
            'correct_answers_number' => 2,
            'wrong_answers_number'   => 1
        ]);

        $this->assertNotEquals($attempt1->getAttributes(), $attempt2->getAttributes());
    }

    public function test_model_attemp_duplication_equal()
    {
        $attempt1 = Attempt::make([
            'exercise_id'            => 1,
            'user_id'                => 2,
            'spend_time'             => '00:42:00',
            'correct_answers_number' => 2,
            'wrong_answers_number'   => 1
        ]);

        $attempt2 = Attempt::make([
            'exercise_id'            => 1,
            'user_id'                => 2,
            'spend_time'             => '00:42:00',
            'correct_answers_number' => 2,
            'wrong_answers_number'   => 1
        ]);

        $this->assertEquals($attempt1, $attempt2);
    }

    public function test_database_contains_implicit_data()
    {
        $this->assertDatabaseHas('attempts', [
            'exercise_id'            => 1,
            'user_id'                => 2,
            'spend_time'             => '00:42:00',
            'correct_answers_number' => 2,
            'wrong_answers_number'   => 1
        ]);
    }

    public function test_database_updateattempt()
    {
        $attempt = Attempt::find(1);

        $attempt->correct_answers_number = 0;
        $attempt->wrong_answers_number   = 3;

        $attempt->save();

        $updatedAttempt = Attempt::find(1);

        $this->assertEquals($attempt->getAttributes(), $updatedAttempt->getAttributes());
    }

    public function test_database_delete_attempt()
    {
        $attempt = Attempt::find(1);

        $attempt->delete();

        $this->assertDeleted($attempt);
    }

    public function test_database_delete_attempt_cascade()
    {
        $attempt = Attempt::find(1);

        $attempt->delete();

        $this->assertDatabaseMissing('attempts', [
            'id' => 1
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 2
        ]);

        $this->assertDatabaseHas('exercises', [
            'id' => 1
        ]);
    }

    public function test_database_data_count()
    {
        $this->assertDatabaseCount('attempts', 101);

        $attempts = Attempt::find(1);

        $attempts->delete();

        $this->assertDatabaseCount('attempts', 100);
    }
}
