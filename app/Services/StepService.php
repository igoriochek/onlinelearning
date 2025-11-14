<?php

namespace App\Services;

use App\Models\Step;

class StepService
{
	public static function getStepRoute(Step $step, string $direction)
	{
		$lesson = $step->lesson;
		$lesson->load('section.course.sections.lessons.steps');
		$course = $lesson->section->course;

		$allSteps = $course->sections
			->flatMap(
				fn($section) => $section->lessons->flatMap(
					fn($lesson) => $lesson->steps,
				),
			)
			->values();

		$currentIndex = $allSteps->search(fn($s) => $s->id === $step->id);

		if ($direction === 'next') {
			$targetStep =
				$currentIndex < $allSteps->count() - 1
					? $allSteps->get($currentIndex + 1)
					: null;
		} elseif ($direction === 'prev') {
			$targetStep =
				$currentIndex > 0 ? $allSteps->get($currentIndex - 1) : null;
		} else {
			throw new \InvalidArgumentException("Invalid direction: $direction");
		}

		return $targetStep
			? [
				'lesson' => $targetStep->lesson_id,
				'position' => $targetStep->position,
			]
			: null;
	}
}
