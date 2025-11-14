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
		$quizSteps = Step::whereIn('type', ['quiz_single', 'quiz_multiple'])->get();

		foreach ($quizSteps as $step) {
			if ($step->options()->count() === 0) {
				$options = [
					['text' => 'Option 1', 'is_correct' => false],
					['text' => 'Option 2', 'is_correct' => true],
					['text' => 'Option 3', 'is_correct' => false],
				];

				if ($step->type === 'quiz_multiple') {
					$options[] = ['text' => 'Option 4', 'is_correct' => true];
				}

				$step->options()->createMany($options);

				$this->command->info("Options added for Step ID: {$step->id}");
			} else {
				$this->command->info(
					"Step ID: {$step->id} already has options, skipping.",
				);
			}
		}
	}
}
