<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lesson;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'lesson_id' => Lesson::inRandomOrder()->first()->id,
			'type' => $this->faker->randomElement([
				'text',
				'video',
				'quiz_single',
				'quiz_multiple',
				'quiz_code',
			]),
			'content' => $this->faker->paragraph(),
			'question' => null,
			'position' => 1,
		];
	}
}
