<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'        => $this->faker->firstName(),
            'last_name'         => $this->faker->lastName(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => bcrypt($this->faker->word()), // password
            'remember_token'    => Str::random(10),
            'degree_front'      => null,
            'degree_after'      => null,
            'type'              => 'student',
            'photo'             => $this->faker->imageUrl(640, 480, 'people', true)
        ];
    }

    public function student()
    {
        return $this->state(function (array $attributes) {
            return [
                'first_name'        => $this->faker->firstName(),
                'last_name'         => $this->faker->lastName(),
                'email'             => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password'          => bcrypt($this->faker->word()), // password
                'remember_token'    => Str::random(10),
                'degree_front'      => null,
                'degree_after'      => null,
                'type'              => User::ROLE_STUDENT,
                'photo'             => $this->faker->imageUrl(640, 480, 'people', true)
            ];
        });
    }

    public function teacher()
    {
        return $this->state(function (array $attributes) {

            return [
                'first_name'        => $this->faker->firstName(),
                'last_name'         => $this->faker->lastName(),
                'email'             => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password'          => bcrypt($this->faker->word()), // password
                'remember_token'    => Str::random(10),
                'degree_front'      => $this->faker->randomElement(['Mgr.', 'Ing.', 'PhDr.', 'Bc.', null]),
                'degree_after'      => $this->faker->randomElement(['Mgr.', 'Ing.', 'PhDr.', null]),
                'type'              => User::ROLE_TEACHER,
                'photo'             => $this->faker->imageUrl(640, 480, 'people', true)
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {

            return [
                'first_name'        => $this->faker->firstName(),
                'last_name'         => $this->faker->lastName(),
                'email'             => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password'          => bcrypt($this->faker->word()), // password
                'remember_token'    => Str::random(10),
                'degree_front'      => null,
                'degree_after'      => null,
                'type'              => User::ROLE_ADMIN,
                'photo'             => $this->faker->imageUrl(640, 480, 'people', true)
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
