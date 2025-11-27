<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'course_id' => Course::inRandomOrder()->first()->id,
      'user_id'   => User::where('role', 'student')->inRandomOrder()->first()->id,
      'rating'    => $this->faker->numberBetween(1, 5),
    ];
  }
}
