<?php
/***********************************************************/
/*                                                         */
/* File: DatabaseSeeder.php                                 */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Default database seeder file               */
/*                                                         */
/***********************************************************/
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ExerciseSeeder::class);
        $this->call(FlashcardSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(AttemptSeeder::class);
    }
}
