<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
use App\Services\AnswerService;
use App\Services\StepNavigator;
use App\Services\ProgressService;

class StepController extends Controller
{
	protected AnswerService $answerService;
	protected StepNavigator $navigator;
	protected ProgressService $progress;

	public function __construct(
		AnswerService $answerService,
		StepNavigator $navigator,
		ProgressService $progress,
	) {
		$this->answerService = $answerService;
		$this->navigator = $navigator;
		$this->progress = $progress;
	}

	public function submit(Step $step, Request $request)
	{
		$request->validate([
			'answer' => 'required',
		]);

		$this->answerService->submitAnswer($step, $request->all());

		$nextStepRoute = $this->navigator->getStepRoute($step, 'next');

		if ($nextStepRoute) {
			return redirect()->route('lessons.step.show', $nextStepRoute);
		}

		return redirect()->route('courses.show', $step->lesson->section->course_id);
	}

	public function completeStep(Step $step)
	{
		$this->progress->markStepCompleted($step);
		return response()->json(['status' => 'completed']);
	}
}
