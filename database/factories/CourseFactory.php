<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $coursePrefix = $this->faker->randomElement(['HTML', 'PHP', 'CSS', 'JS', 'SQL', 'NET']);
        
        return [
            'name' => fake()->words(3, true),
            'courseID' => $coursePrefix . fake()->unique()->numerify('####'),
            'description' => fake()->paragraph(),
            'faculty_id' => Faculty::factory()  // This will create a faculty if none exists
        ];
    }

    /**
     * Indicate that the course belongs to an existing faculty.
     */
    public function withExistingFaculty()
    {
        return $this->state(function (array $attributes) {
            return [
                'faculty_id' => Faculty::inRandomOrder()->first()?->id ?? Faculty::factory(),
            ];
        });
    }

    /**
     * Indicate that the course has no faculty assigned.
     */
    public function withoutFaculty()
    {
        return $this->state(function (array $attributes) {
            return [
                'faculty_id' => null,
            ];
        });
    }
}