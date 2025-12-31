<?php

namespace Database\Factories;

use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => fake()->unique()->numerify('23########'),
            'name' => fake()->name(),
            'study_program_id' => StudyProgram::factory(),
            'user_id' => User::factory()->state([
                'role' => '3', // student
            ]),
        ];
    }
}
