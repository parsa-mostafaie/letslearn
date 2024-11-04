<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users
        $users = User::factory()->count(10)->create();

        // For each user, create 3 courses and enroll them in random courses
        foreach ($users as $user) {
            // Create 3 courses for each user as an author
            $courses = Course::factory()->count(rand(3, 10))->create(['user_id' => $user->id]);

            // Enroll each user in random courses (including their own)
            foreach ($courses as $course) {
                // Randomly decide how many courses to enroll in (including their own)
                if (rand(0, 1)) {
                    // Enroll in their own course
                    $user->enrolledCourses()->attach($course);
                }

                // Optionally, enroll them in other random courses (excluding their own)
                $otherCourses = Course::where('id', '!=', $course->id)->inRandomOrder()->take(rand(1, 2))->get();
                foreach ($otherCourses as $otherCourse) {
                    $user->enrolledCourses()->attach($otherCourse);
                }
            }
        }
    }
}
