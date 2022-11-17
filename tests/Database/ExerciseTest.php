<?php

namespace Tests\Database;

use App\Models\Exercise;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ExerciseTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_exercise_exists()
    {
        $exercise = Exercise::factory()->create();

        $this->assertModelExists($exercise);
    }

    public function test_model_exercise_delete()
    {
        $exercise = Exercise::find(1);

        $exercise->delete();

        $this->assertDeleted($exercise);
    }

    public function test_model_exercise_duplication()
    {
        $exercise1 = Exercise::make([
            'name'         => 'ISA',
            'description'  => 'Síťové aplikace a jejich architektura',
            'topic'        => 'Počítačové sítě'
        ]);

        $exercise2 = Exercise::make([
            'name'        => 'INP',
            'description' => 'Návrh počítačových systémů',
            'topic'       => 'Číslicové systémy'
        ]);

        $this->assertNotEquals($exercise1, $exercise2);
    }

    public function test_model_exercise_duplication_equal()
    {
        $exercise1 = Exercise::make([
            'name'        => 'INP',
            'description' => 'Návrh počítačových systémů',
            'topic'       => 'Číslicové systémy'
        ]);

        $exercise2 = Exercise::make([
            'name'        => 'INP',
            'description' => 'Návrh počítačových systémů',
            'topic'       => 'Číslicové systémy'
        ]);

        $this->assertEquals($exercise1, $exercise2);
    }

    public function test_database_contains_implicit_data()
    {
        $this->assertDatabaseHas('exercises', [
            'author'      => 3,
            'name'        => 'Elektrotechnické měření',
            'description' => 'Kartičky pro procvičení základních pojmů z předmětu ELM',
            'topic'       => 'Elektrotechnika'
        ]);

    }

    public function test_database_update_exercise()
    {
        $exercise = Exercise::find(1);

        $exercise->name = 'IIS';
        $exercise->description = 'Informační systémy';

        $exercise->save();

        $updatedExercise = Exercise::find(1);

        $this->assertEquals($exercise->getAttributes(), $updatedExercise->getAttributes());
    }

    public function test_database_delete_exercise()
    {
        $exercise = Exercise::find(1);

        $exercise->delete();

        $this->assertDeleted($exercise);
    }

    public function test_database_delete_exercise_cascade()
    {
        $exercise = Exercise::find(1);

        $exercise->delete();

        $this->assertDatabaseMissing('attempts', [
            'exercise_id' => 1
        ]);

        $this->assertDatabaseMissing('flashcards', [
            'exercise_id' => 1
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 3
        ]);
    }

    public function test_database_data_count()
    {
        $this->assertDatabaseCount('exercises', 20);

        $exercise = Exercise::find(1);

        $exercise->delete();

        $this->assertDatabaseCount('exercises', 19);
    }
}
