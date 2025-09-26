<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Services\StepNavigator;

class LessonController extends Controller
{
	public function show(Lesson $lesson, $stepPosition)
	{
		$lesson->load('section.course.sections.lessons.steps');
		$course = $lesson->section->course;

		$step = $lesson->steps()->where('position', $stepPosition)->firstOrFail();

		$prevStepRoute = StepNavigator::getStepRoute($step, 'prev');
		$nextStepRoute = StepNavigator::getStepRoute($step, 'next');

		return view(
			'lessons.show',
			compact('course', 'lesson', 'step', 'prevStepRoute', 'nextStepRoute'),
		);
	}
}
