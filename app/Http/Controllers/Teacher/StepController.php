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
			'content_text' => 'required_if:type,text|string|nullable',
			'content_video' => 'required_if:type,video|string|nullable',
		]);

		$position = $lesson->steps()->max('position') + 1;

		$content = $request->input(
			$request->type === 'text' ? 'content_text' : 'content_video',
		);

		$lesson->steps()->create([
			'question' => $validated['question'] ?? null,
			'type' => $validated['type'],
			'position' => $position,
			'content' => $content,
		]);

		return redirect()
			->route('teacher.lessons.steps.index', $lesson->id)
			->with('success', 'Step created successfully.');
	}

	public function create(Lesson $lesson)
	{
		return view('teacher.steps.create', compact('lesson'));
	}
}
