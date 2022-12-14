<?php
/***********************************************************/
/*                                                         */
/* File: ExerciseSeeder.php                                */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Seeder for Exercise model                  */
/*                                                         */
/***********************************************************/
namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exercise::factory()->create([
            'author'      => 3,
            'name'        => 'Elektrotechnické měření',
            'description' => 'Kartičky pro procvičení základních pojmů z předmětu ELM',
            'topic'       => 'Elektrotechnika',
            'visibility'  => 'private',
            'show_timer'  => true
        ]);
        Exercise::factory()->times(19)->create();
    }
}
