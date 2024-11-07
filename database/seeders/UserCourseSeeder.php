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
        $users = User::inRandomOrder()->take(10)->get();

        // For each user, create 3-10 courses and enroll them in random courses
        foreach ($users as $user) {
            // Create 3-10 courses for each user as an author
            $courses = Course::factory()->count(rand(3, 10))->create(['user_id' => $user->id]);

            // Optionally, enroll in other random courses (excluding their own)
            $otherCourses = Course::whereNotIn('id', $courses->pluck('id'))
                ->inRandomOrder()
                ->take(rand(3, 10))->get();

            foreach ($otherCourses as $otherCourse) {
                $user->enrolledCourses()->attach($otherCourse);
            }

        }
    }
}
