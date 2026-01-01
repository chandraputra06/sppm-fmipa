<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'category' => fake()->randomElement(['1', '2']),
            'grade' => fake()->randomElement(['Lokal', 'Nasional', 'Internasional']),
            'date' => fake()->dateTimeBetween('-1 years', 'now'),
            'proof' => 'bukti/' . fake()->unique()->lexify('file_????') . '.pdf',
            'photo' => 'foto/' . fake()->unique()->lexify('image_????') . '.jpg',
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['Draft', 'Verified', 'Publish']),
            'student_id' => Student::factory(),
        ];
    }
}
