<?php

namespace App\Services;
use App\Models\Step;
use App\Models\Section;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class ProgressService
{
	public function stepCompleted(Step $step, $userId = null): bool
	{
		$userId ??= Auth::id();
		return Progress::where('step_id', $step->id)
			->where('user_id', $userId)
			->where('is_completed', true)
			->exists();
	}

	public function markStepCompleted(Step $step, $userId = null): void
	{
		$userId ??= Auth::id();
		Progress::updateOrCreate(
			['step_id' => $step->id, 'user_id' => $userId],
			['is_completed' => true],
		);
	}

	public function sectionCompleted(Section $section, $userId = null): bool
	{
		$userId ??= Auth::id();
		$totalSteps = $section->lessons
			->flatMap(fn($lesson) => $lesson->steps)
			->count();
		$completedSteps = $section->lessons
			->flatMap(fn($lesson) => $lesson->steps)
			->filter(fn($step) => $this->stepCompleted($step, $userId))
			->count();
		return $totalSteps > 0 && $totalSteps === $completedSteps;
	}

	public function getFirstIncompleteStep($lesson, $userId = null): ?Step
	{
		$userId ??= Auth::id();
		return $lesson->steps->first(
			fn($step) => !$this->stepCompleted($step, $userId),
		);
	}
}
