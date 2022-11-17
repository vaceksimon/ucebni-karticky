<?php

namespace Tests\Database;

use Tests\TestCase;
use App\Models\Flashcard;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlashcardTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_flashcard_exists()
    {
        $flashcard = Flashcard::factory()->create();

        $this->assertModelExists($flashcard);
    }

    public function test_model_flashcard_delete()
    {
        $flashcard = Flashcard::factory()->create();

        $flashcard->delete();

        $this->assertModelMissing($flashcard);
    }

    public function test_model_flashcard_duplication()
    {
        $flashcard1 = Flashcard::make([
            'question' => 'Question1',
            'answer'   => 'Answer1',
        ]);

        $flashcard2 = Flashcard::make([
            'question' => 'Question2',
            'answer'   => 'Answer2',
        ]);

        $this->assertNotEquals($flashcard1->getAttributes(), $flashcard2->getAttributes());
    }

    public function test_database_contains_implicit_data()
    {
        $this->assertDatabaseHas('flashcards', [
            'exercise_id' => 1,
            'question'    => 'Co je to osciloskop',
            'answer'      => 'Osciloskop je elektronický měřicí přístroj s obrazovkou vykreslující časový průběh měřeného napěťového signálu.'
        ]);

        $this->assertDatabaseHas('flashcards', [
            'exercise_id' => 1,
            'question'    => 'Co je to multimetr',
            'answer'      => 'Multimetr (nebo také multitester) je elektronický měřicí přístroj, který v sobě kombinuje několik funkcí'
        ]);

        $this->assertDatabaseHas('flashcards', [
            'exercise_id' => 1,
            'question'    => 'Co je to rezistor',
            'answer'      => 'Rezistor je pasivní elektrotechnická součástka projevující se v elektrickém obvodu v ideálním případě jedinou vlastností – elektrickým odporem (jednotka Ohm, značka Ω).'
        ]);
    }

    public function test_database_update_flashcard()
    {
        $flashcard = Flashcard::find(1);

        $flashcard->question = 'UpdatedQuestion';
        $flashcard->answer   = 'UpdateAnswer';

        $flashcard->save();

        $updatedFlashcard = Flashcard::find(1);

        $this->assertEquals($flashcard->getAttributes(), $updatedFlashcard->getAttributes());
    }

    public function test_database_delete_flashcard()
    {
        $flashcard = Flashcard::find(1);

        $flashcard->delete();

        $this->assertDeleted($flashcard);
    }

    public function test_database_delete_flashcard_cascade()
    {
        $user = Flashcard::find(1);

        $user->delete();

        $this->assertDatabaseMissing('flashcards', [
            'id' => 1
        ]);

        $this->assertDatabaseHas('exercises', [
            'id' => 1
        ]);
    }

    public function test_database_data_count()
    {
        $this->assertDatabaseCount('flashcards', 203);

        $flashcard = Flashcard::find(1);

        $flashcard->delete();

        $this->assertDatabaseCount('flashcards', 202);
    }
}
