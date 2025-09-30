<?php

namespace App\Services;
use App\Models\Step;
use App\Models\Progress;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class ProgressService
{
	public function stepCompleted(Step $step): bool
	{
		$userId = Auth::id();
		return Progress::where('step_id', $step->id)
			->where('user_id', $userId)
			->where('is_completed', true)
			->exists();
	}

	public function markStepCompleted(Step $step): void
	{
		$userId = Auth::id();
		Progress::updateOrCreate(
			['step_id' => $step->id, 'user_id' => $userId],
			['is_completed' => true],
		);
	}

	public function getCompletedSteps(Lesson $lesson): array
	{
		$userId = Auth::id();
		return Progress::where('user_id', $userId)
			->whereIn('step_id', $lesson->steps->pluck('id'))
			->where('is_completed', true)
			->pluck('step_id')
			->toArray();
	}
}
