<?php

namespace App\Services;

use App\Models\Step;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerService
{
	protected ProgressService $progress;

	public function __construct(ProgressService $progress)
	{
		$this->progress = $progress;
	}

	public function submitAnswer(Step $step, array $data): void
	{
		$userId = Auth::id();

		if (in_array($step->type, ['quiz_single', 'quiz_multiple'])) {
			$selectedOptions = $data['answer'] ?? [];
			if (!is_array($selectedOptions)) {
				$selectedOptions = [$selectedOptions];
			}

			Answer::updateOrCreate(
				['step_id' => $step->id, 'user_id' => $userId],
				[
					'selected_options' => json_encode($selectedOptions),
				],
			);
		} elseif ($step->type === 'quiz_code') {
			Answer::updateOrCreate(
				['step_id' => $step->id, 'user_id' => $userId],
				['code_answer' => $data['code_answer'] ?? null],
			);
		}
		$this->progress->markStepCompleted($step);
	}
}
