<?php

namespace Database\Seeders;

use App\Models\Flashcard;
use Illuminate\Database\Seeder;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flashcard::factory()->times(200)->create();
    }
}
