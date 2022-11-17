<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Group::factory()->teachers()->create([
            'owner'       => 3,
            'name'        => 'SSPTAJI',
            'description' => 'Střední škola technická, průmyslová a automobilní Jihlava',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg'
        ]);

        Group::factory()->students()->create([
            'owner'       => 3,
            'name'        => 'ELM',
            'description' => 'Elektrotechnícké měření - IT4A',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg'
        ]);

        Group::factory(5)->teachers()->create();
        Group::factory(20)->students()->create();
    }
}
