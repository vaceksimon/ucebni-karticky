<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Group::factory()->create([
            'owner' => 3,
            'name' => 'SSPTAJI',
            'description' => 'Střední škola technická, průmyslová a automobilní Jihlava',
            'photo' => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg',
            'type' => 'teachers'
        ]);

        Group::factory()->create([
            'owner' => 3,
            'name' => 'ELM',
            'description' => 'Elektrotechnícké měření - IT4A',
            'photo' => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg',
            'type' => 'students'
        ]);

        Group::factory()->times(25)->create();
    }
}
