<?php

namespace Database\Seeders;

use App\Models\Flashcard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('flashcards')->insert([
            'exercise_id' => 1,
            'question'    => 'Co je to osciloskop',
            'answer'      => 'Osciloskop je elektronický měřicí přístroj s obrazovkou vykreslující časový průběh měřeného napěťového signálu.'
        ]);

        DB::table('flashcards')->insert([
            'exercise_id' => 1,
            'question'    => 'Co je to multimetr',
            'answer'      => 'Multimetr (nebo také multitester) je elektronický měřicí přístroj, který v sobě kombinuje několik funkcí'
        ]);

        DB::table('flashcards')->insert([
            'exercise_id' => 1,
            'question'    => 'Co je to rezistor',
            'answer'      => 'Rezistor je pasivní elektrotechnická součástka projevující se v elektrickém obvodu v ideálním případě jedinou vlastností – elektrickým odporem (jednotka Ohm, značka Ω).'
        ]);

        Flashcard::factory()->times(200)->create();
    }
}
