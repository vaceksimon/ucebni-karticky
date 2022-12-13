<?php
/***********************************************************/
/*                                                         */
/* File: FlashcardSeeder.php                               */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Seeder for Flashcard model                 */
/*                                                         */
/***********************************************************/
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

        Flashcard::factory()->create([
            'exercise_id' => 1,
            'question'    => 'Co je to osciloskop',
            'answer'      => 'Osciloskop je elektronický měřicí přístroj s obrazovkou vykreslující časový průběh měřeného napěťového signálu.'
        ]);

        Flashcard::factory()->create([
            'exercise_id' => 1,
            'question'    => 'Co je to multimetr',
            'answer'      => 'Multimetr (nebo také multitester) je elektronický měřicí přístroj, který v sobě kombinuje několik funkcí'
        ]);

        Flashcard::factory()->create([
            'exercise_id' => 1,
            'question'    => 'Co je to rezistor',
            'answer'      => 'Rezistor je pasivní elektrotechnická součástka projevující se v elektrickém obvodu v ideálním případě jedinou vlastností – elektrickým odporem (jednotka Ohm, značka Ω).'
        ]);

        Flashcard::factory()->times(200)->create();
    }
}
