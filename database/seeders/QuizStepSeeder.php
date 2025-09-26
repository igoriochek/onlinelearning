<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Step;

class QuizStepSeeder extends Seeder
{
	public function run(): void
	{
		$quizSteps = Step::where('type', 'quiz')->get();

		foreach ($quizSteps as $step) {
			if ($step->options()->count() === 0) {
				$step
					->options()
					->createMany([
						['text' => 'Option 1', 'is_correct' => false],
						['text' => 'Option 2', 'is_correct' => true],
						['text' => 'Option 3', 'is_correct' => false],
					]);

				$this->command->info("Options added for Step ID: {$step->id}");
			} else {
				$this->command->info(
					"Step ID: {$step->id} already has options, skipping.",
				);
			}
		}
	}
}
