<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'id' => $this->faker->md5(),
            'email' => 'admin@cann.my.id',
            'password' => bcrypt('Acbd1234'),
            'name' => 'Admin',
            'phone' => '1231231231',
            'gender' => 'hidden',
            'address' => 'ksandkjandkjandkjasdn',
            'date_born' => $this->faker->date(),
            'profile_pic' => '',
            'email_verified_at' => now(),
            'remember_token' => '',
            // 'role_id' => 255,

            // 'id' => $this->faker->md5(),
            // 'email' => $this->faker->unique()->safeEmail(),
            // 'password' => bcrypt('password'),
            // 'name' => $this->faker->name(),
            // 'phone' => $this->faker->e164PhoneNumber(),
            // 'gender' => $this->faker->randomElement(['male', 'female', 'hidden']),
            // 'address' => $this->faker->address(),
            // 'date_born' => $this->faker->date(),
            // 'profile_pic' => $this->faker->randomElement(['a.jpg', 'b.jpg', 'c.jpg']),
            // 'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),
            // 'role_id' => $this->faker->numberBetween(1, 255),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        // return $this->state(function (array $attributes) {
        //     return [
        //         'email_verified_at' => null,
        //     ];
        // });
    }
}
