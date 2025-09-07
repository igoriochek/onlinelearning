<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
	public function definition()
	{
		return [
			'title' => $this->faker->word,
			'description' => $this->faker->sentence,
			'level' => rand(1, 3),
			'price' => $this->faker->randomFloat(2, 10, 100),
			'image_url' => 'https://placehold.co/600x400?text=Course+Image',
			'author_id' =>
				optional(User::where('role', 'teacher')->inRandomOrder()->first())
					->id ?? User::factory()->create(['role' => 'teacher'])->id,
		];
	}
}
