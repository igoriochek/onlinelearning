<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Services\StepService;
use App\Services\ProgressService;

class LessonController extends Controller
{
	protected ProgressService $progressService;

	public function __construct(ProgressService $progressService)
	{
		$this->progressService = $progressService;
	}

	public function show(Lesson $lesson, $stepPosition)
	{
		$lesson->load('section.course.sections.lessons.steps');
		$course = $lesson->section->course;

		$step = $lesson->steps()->where('position', $stepPosition)->firstOrFail();

		$prevStepRoute = StepService::getStepRoute($step, 'prev');
		$nextStepRoute = StepService::getStepRoute($step, 'next');

		$isCompleted = $this->progressService->stepCompleted($step);

		$completedSteps = $this->progressService->getCompletedSteps($lesson);

		return view(
			'lessons.show',
			compact(
				'course',
				'lesson',
				'step',
				'prevStepRoute',
				'nextStepRoute',
				'isCompleted',
				'completedSteps',
			),
		);
	}
}
