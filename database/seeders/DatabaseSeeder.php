<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Step;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::factory()->create([
			'name' => 'Admin',
			'password' => 'admin',
			'email' => 'admin@example.com',
			'role' => 'admin',
		]);

		User::factory()->create([
			'name' => 'Teacher',
			'email' => 'teacher@example.com',
			'password' => 'teacher',
			'role' => 'teacher',
		]);

		User::factory()->create([
			'name' => 'Student',
			'email' => 'student@example.com',
			'password' => 'student',
			'role' => 'student',
		]);

		Course::factory(1)
			->create()
			->each(function ($course) {
				Review::factory(5)->create(['course_id' => $course->id]);
				Section::factory(3)
					->create(['course_id' => $course->id])
					->each(function ($section, $sectionIndex) {
						$section->position = $sectionIndex + 1;
						$section->save();

						Lesson::factory(2)
							->create(['section_id' => $section->id])
							->each(function ($lesson, $lessonIndex) {
								$lesson->position = $lessonIndex + 1;
								$lesson->save();

								Step::factory(5)
									->create(['lesson_id' => $lesson->id])
									->each(function ($step, $stepIndex) {
										$step->position = $stepIndex + 1;

										if ($stepIndex === 1) {
											$step->type = 'video';
											$step->question = 'No question for video step.';
										} elseif ($stepIndex === 2) {
											$step->type = 'text';
											$step->question = 'Sample question?';
										} elseif ($stepIndex === 3) {
											$step->type = 'quiz_multiple';
											$step->question = 'Select all correct answers.';
										} elseif ($stepIndex == 4) {
											$step->type = 'quiz_single';
											$step->question = 'Select one correct answer.';
										} else {
											$step->type = 'quiz_code';
											$step->question = 'Write some code below.';
										}
										$step->save();
									});
							});
					});
			});
	}
}
