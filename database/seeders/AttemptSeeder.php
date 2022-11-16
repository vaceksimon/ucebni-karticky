<?php

namespace Database\Seeders;

use App\Models\Attempt;
use Illuminate\Database\Seeder;

class AttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attempt::factory()->times(100)->create();
    }
}
