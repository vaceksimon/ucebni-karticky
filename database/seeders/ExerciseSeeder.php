<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->insert([
            'author'      => 3,
            'name'        => 'Elektrotechnické měření',
            'description' => 'Kartičky pro procvičení základních pojmů z předmětu ELM',
            'topic'       => 'Elektrotechnika'
        ]);

        Exercise::factory()->times(19)->create();
    }
}
