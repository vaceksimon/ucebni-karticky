<?php
/***********************************************************/
/*                                                         */
/* File: UserSeeder.php                                    */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Seeder for User model                      */
/*                                                         */
/***********************************************************/
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
        User::factory()->admin()->create([
            'first_name' => 'admin',
            'last_name'  => 'admin',
            'email'      => 'admin@example.com',
            'password'   => bcrypt('admin')
        ]);
        // Student
        User::factory()->student()->create([
            'first_name' => 'Marek',
            'last_name'  => 'Dočekal',
            'email'      => 'speedy@example.com',
            'password'   => bcrypt('BigShock')
        ]);
        // Teacher
        User::factory()->teacher()->create([
            'degree_front' => 'Dr.',
            'first_name'   => 'Bohumil',
            'last_name'    => 'Brtník',
            'degree_after' => 'Ing.',
            'email'        => 'BBELM@example.com',
            'password'     => bcrypt('Osciloskop123')
        ]);
        // Fake data
        User::factory(27)->teacher()->create();
        User::factory(70)->student()->create();
    }
}
