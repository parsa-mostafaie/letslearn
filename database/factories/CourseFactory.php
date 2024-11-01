<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'title' => $title = $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'slug' => Str::slug($title),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'user_id' => User::factory(), // Associate with a user (author)
        ];
    }
}
