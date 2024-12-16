<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Create some predefined courses
        $courses = [
            [
                'name' => 'Web Development',
                'courseID' => 'HTML5225',
                'description' => 'Learn modern web development techniques',
                'faculty_id' => Faculty::inRandomOrder()->first()?->id
            ],
            [
                'name' => 'PHP Programming',
                'courseID' => 'PHP5226',
                'description' => 'Server-side programming with PHP',
                'faculty_id' => Faculty::inRandomOrder()->first()?->id
            ],
            [
                'name' => 'Database Design',
                'courseID' => 'SQL5227',
                'description' => 'Database design and implementation',
                'faculty_id' => Faculty::inRandomOrder()->first()?->id
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        // Create additional random courses
        Course::factory(7)->withExistingFaculty()->create();
    }
}