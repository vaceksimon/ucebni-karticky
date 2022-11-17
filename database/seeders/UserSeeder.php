<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::factory()->create([
            'first_name'        => 'admin',
            'last_name'         => 'admin',
            'email'             => 'admin@example.com',
            'password'          => 'admin',
            'type'              => 'admin'
        ]);
        // Student
        User::factory()->create([
            'first_name'        => 'Marek',
            'last_name'         => 'Dočekal',
            'email'             => 'speedy@example.com',
            'password'          => 'BigShock',
            'type'              => 'student'
        ]);
        // Teacher
        User::factory()->create([
            'degree_front'      => 'Dr.',
            'first_name'        => 'Bohumil',
            'last_name'         => 'Brtník',
            'degree_after'      => 'Ing.',
            'email'             => 'BBELM@example.com',
            'password'          => 'Osciloskop123',
            'type'              => 'teacher'
        ]);
        // Fake data
        User::factory(27)->teacher()->create();
        User::factory(70)->student()->create();
    }
}
