<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create faculties first
        Faculty::factory(5)->create();

        // Create courses
        Course::factory()->create([
            'courseID' => 'HTTP5225',
            'name' => 'ASP.NET',  // Changed from courseName to name
            'description' => 'Let\'s learn C# and ASP.NET',
            'faculty_id' => Faculty::first()->id
        ]);

        Course::factory(9)->create();

        // Create students and attach random courses
        Student::factory(20)->create()->each(function ($student) {
            // Attach 2-4 random courses to each student
            $courses = Course::inRandomOrder()->take(rand(2, 4))->pluck('id');
            $student->courses()->attach($courses);
        });
    }
}