<?php

namespace App\Services;

use App\Models\Step;
use App\Models\Progress;
use App\Models\Lesson;
use App\Models\Course;
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

  public function markStepCompleted(Step $step, ?bool $isCorrect = null): void
  {
    $userId = Auth::id();

    $completed = $isCorrect === null ? true : $isCorrect;

    Progress::updateOrCreate(
      ['step_id' => $step->id, 'user_id' => $userId],
      ['is_completed' => $completed]
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

  public function getNotCompletedSteps(Lesson $lesson): array
  {
    $userId = Auth::id();

    return Progress::where('user_id', $userId)
      ->whereIn('step_id', $lesson->steps->pluck('id'))
      ->where('is_completed', false)
      ->pluck('step_id')
      ->toArray();
  }

  public function getCourseProgress(Course $course): array
  {
    $userId = Auth::id();

    $allStepIds = $course->sections
      ->flatMap(fn($section) => $section->lessons)
      ->flatMap(fn($lesson) => $lesson->steps)
      ->pluck('id');

    $totalSteps = $allStepIds->count();

    if ($totalSteps === 0) {
      return [
        'total' => 0,
        'completed' => 0,
        'percent' => 0,
      ];
    }

    $completed = Progress::where('user_id', $userId)
      ->whereIn('step_id', $allStepIds)
      ->where('is_completed', true)
      ->count();

    $notCorrect = Progress::where('user_id', $userId)
      ->whereIn('step_id', $allStepIds)
      ->where('is_completed', false)
      ->pluck('step_id')
      ->toArray();

    return [
      'total' => $totalSteps,
      'completed' => $completed,
      'notCorrect' => $notCorrect,
      'percent' => round(($completed / $totalSteps) * 100),
    ];
  }
}
