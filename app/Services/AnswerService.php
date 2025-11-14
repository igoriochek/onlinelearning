<?php

namespace App\Services;

use App\Models\Step;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerService
{
	protected ProgressService $progressService;

	public function __construct(ProgressService $progressService)
	{
		$this->progressService = $progressService;
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
				['code_answer' => $data['answer'] ?? null],
			);
		}
		$this->progressService->markStepCompleted($step);
	}
}
