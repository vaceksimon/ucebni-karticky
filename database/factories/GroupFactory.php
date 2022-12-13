<?php
/***********************************************************/
/*                                                         */
/* File: GroupFactory.php                                  */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Factory for Group model                    */
/*                                                         */
/***********************************************************/
namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teacher = DB::table('users')->select('id')->where('account_type', 'teacher')->pluck('id');

        return [
            'owner'       => $this->faker->randomElement($teacher),
            'name'        => $this->faker->words(5, true),
            'description' => $this->faker->sentence(4),
            'photo'       => $this->faker->imageUrl(640, 480, 'abstract', true),
            'type'        => $this->faker->randomElement([Group::STUDENTS_GROUP, Group::TEACHERS_GROUP])
        ];
    }

    public function teachers()
    {
        return $this->state(function (array $attributes) {
            $teacher = DB::table('users')->select('id')->where('account_type', 'teacher')->pluck('id');

            return [
                'owner'       => $this->faker->randomElement($teacher),
                'name'        => $this->faker->words(5, true),
                'description' => $this->faker->sentence(4),
                'photo'       => $this->faker->imageUrl(640, 480, 'abstract', true),
                'type'        => Group::TEACHERS_GROUP
            ];
        });
    }

    public function students()
    {
        return $this->state(function (array $attributes) {
            $teacher = DB::table('users')->select('id')->where('account_type', 'teacher')->pluck('id');

            return [
                'owner'       => $this->faker->randomElement($teacher),
                'name'        => $this->faker->words(5, true),
                'description' => $this->faker->sentence(4),
                'photo'       => $this->faker->imageUrl(640, 480, 'abstract', true),
                'type'        => Group::STUDENTS_GROUP
            ];
        });
    }
}
