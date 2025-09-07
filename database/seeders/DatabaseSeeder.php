<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Step;
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

		Course::factory(5)
			->create()
			->each(function ($course) {
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

								Step::factory(2)
									->create(['lesson_id' => $lesson->id])
									->each(function ($step, $stepIndex) {
										$step->position = $stepIndex + 1;

										if ($stepIndex === 1) {
											$step->type = 'quiz';
											$step->question = 'Sample question?';
										} else {
											$step->type = 'text';
										}

										$step->save();
									});
							});
					});
			});
	}
}
