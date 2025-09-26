<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Answer;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StepNavigator;

class StepController extends Controller
{
	public function submit(Step $step, Request $request)
	{
		$request->validate([
			'answer' => 'required|exists:options,id',
		]);

		$selectedOption = $step->options()->findOrFail($request->answer);

		Answer::updateOrCreate(
			[
				'user_id' => Auth::id(),
				'step_id' => $step->id,
			],
			[
				'selected_options' => json_encode([$selectedOption->id]),
				'answer_text' => $selectedOption->text,
			],
		);

		Progress::updateOrCreate(
			[
				'user_id' => Auth::id(),
				'step_id' => $step->id,
			],
			['is_completed' => true],
		);

		$nextStepRoute = StepNavigator::getStepRoute($step, 'next');

		if ($nextStepRoute) {
			return redirect()->route('lessons.step.show', $nextStepRoute);
		}

		return redirect()->route('courses.show', $step->lesson->section->course_id);
	}
}
