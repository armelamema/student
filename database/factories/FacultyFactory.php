<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'department' => fake()->randomElement([
                'Computer Science',
                'Information Technology',
                'Web Development',
                'Software Engineering',
                'Digital Media'
            ])
        ];
    }
}