<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
	public function show(Lesson $lesson, $stepPosition)
	{
		$lesson->load('section.course.sections.lessons.steps');
		$course = $lesson->section->course;

		$step = $lesson->steps()->where('position', $stepPosition)->firstOrFail();

		$allSteps = $course->sections
			->flatMap(
				fn($section) => $section->lessons->flatMap(
					fn($lesson) => $lesson->steps,
				),
			)
			->values();

		$currentIndex = $allSteps->search(fn($s) => $s->id === $step->id);

		$prevStep = $currentIndex > 0 ? $allSteps->get($currentIndex - 1) : null;
		$nextStep =
			$currentIndex < $allSteps->count() - 1
				? $allSteps->get($currentIndex + 1)
				: null;

		$prevStepRoute = $prevStep
			? ['lesson' => $prevStep->lesson_id, 'position' => $prevStep->position]
			: null;
		$nextStepRoute = $nextStep
			? ['lesson' => $nextStep->lesson_id, 'position' => $nextStep->position]
			: null;

		return view(
			'lessons.show',
			compact('course', 'lesson', 'step', 'prevStepRoute', 'nextStepRoute'),
		);
	}
}
