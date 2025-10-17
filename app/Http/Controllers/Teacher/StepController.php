<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Lesson;
use App\Models\Step;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StepController extends Controller
{
	public function index(Lesson $lesson)
	{
		return view('teacher.steps.index', compact('lesson'));
	}

	public function store(Request $request, Lesson $lesson)
	{
		$validated = $request->validate([
			'question' => 'nullable|string|max:255',
			'type' => 'required|in:text,video,quiz_single,quiz_multiple',
		]);

		$position = $lesson->steps()->max('position') + 1;

		$lesson->steps()->create([
			'question' => $validated['question'] ?? null,
			'type' => $validated['type'],
			'position' => $position,
		]);

		return redirect()
			->route('teacher.lessons.steps.index', $lesson->id)
			->with('success', 'Step created successfully.');
	}
}
