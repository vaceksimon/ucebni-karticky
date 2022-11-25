<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Group;
use App\Models\User;
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

        $teacher = Group::factory()->teachers()->create([
            'owner'       => 3,
            'name'        => 'SSPTAJI',
            'description' => 'Střední škola technická, průmyslová a automobilní Jihlava',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg'
        ]);

        $student = Group::factory()->students()->create([
            'owner'       => 3,
            'name'        => 'ELM',
            'description' => 'Elektrotechnícké měření - IT4A',
            'photo'       => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Digitaloszilloskop_IMGP1971_WP.jpg'
        ]);

        Group::factory(5)->teachers()->create();
        Group::factory(20)->students()->create();

        Group::all()->where('type', '=', Group::TEACHERS_GROUP)->each(function ($group)
        {
            $teachers = User::all()->random(rand(0,27))
                ->where('account_type', '=', User::ROLE_TEACHER)
                ->where('id', '>', 1);
            $group->members()->attach(
                $teachers->pluck('id')->toArray()
            );
        });

        Group::all()->where('type', '=', Group::STUDENTS_GROUP)->each(function ($group)
        {
            $students = User::all()->random(rand(0,70))
                ->where('account_type', '=', User::ROLE_STUDENT)
                ->where('id', '>', 1);
            $group->members()->attach(
                $students->pluck('id')->toArray()
            );
        });

        $teacher->members()->attach(3);
        $student->members()->attach(2);

        Group::all()->where('type', '=', Group::STUDENTS_GROUP)->each(function ($group)
        {
            $exercises = Exercise::all()->random(rand(1,4));

            $group->assigned()->attach(
                $exercises->pluck('id')->toArray()
            );
        });

        $student->assigned()->attach(1);

        Group::all()->where('type', '=', Group::TEACHERS_GROUP)->each(function ($group)
        {
           $exercise = Exercise::all()->where('author', '!=', $group->owner)->random(rand(0,2));

           $group->groupsSharing()->attach(
               $exercise->pluck('id')->toArray()
           );
        });

        $teacher->groupsSharing()->attach(2);
    }
}
