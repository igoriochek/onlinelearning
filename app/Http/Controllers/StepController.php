<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
use App\Services\AnswerService;
use App\Services\StepService;
use App\Services\ProgressService;

class StepController extends Controller
{
	protected AnswerService $answerService;
	protected StepService $stepService;
	protected ProgressService $progressService;

	public function __construct(
		AnswerService $answerService,
		StepService $stepService,
		ProgressService $progressService,
	) {
		$this->answerService = $answerService;
		$this->stepService = $stepService;
		$this->progressService = $progressService;
	}

	public function submit(Step $step, Request $request)
	{
		$request->validate([
			'answer' => 'required',
		]);

		$this->answerService->submitAnswer($step, $request->all());

		$nextStepRoute = $this->stepService->getStepRoute($step, 'next');

		if ($nextStepRoute) {
			return redirect()->route('lessons.step.show', $nextStepRoute);
		}

		return redirect()->route('courses.show', $step->lesson->section->course_id);
	}

	public function completeStep(Step $step)
	{
		$this->progressService->markStepCompleted($step);
		return response()->json(['status' => 'completed']);
	}
}
