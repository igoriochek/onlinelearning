<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Services\StepNavigator;
use App\Services\ProgressService;

class LessonController extends Controller
{
	protected ProgressService $progress;

	public function __construct(ProgressService $progress)
	{
		$this->progress = $progress;
	}

	public function show(Lesson $lesson, $stepPosition)
	{
		$lesson->load('section.course.sections.lessons.steps');
		$course = $lesson->section->course;

		$step = $lesson->steps()->where('position', $stepPosition)->firstOrFail();

		$prevStepRoute = StepNavigator::getStepRoute($step, 'prev');
		$nextStepRoute = StepNavigator::getStepRoute($step, 'next');

		$isCompleted = $this->progress->stepCompleted($step);

		return view(
			'lessons.show',
			compact(
				'course',
				'lesson',
				'step',
				'prevStepRoute',
				'nextStepRoute',
				'isCompleted',
			),
		);
	}
}
