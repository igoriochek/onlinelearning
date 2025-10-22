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
		$type = $request->input('type');
		$quizType = $request->input('quiz_type');

		$rules = [
			'type' => 'required|in:text,video,quiz',
			'question' =>
				$type === 'quiz'
					? 'required|string|max:255'
					: 'nullable|string|max:255',
			'content_text' => 'required_if:type,text|string|nullable',
			'content_video' => 'required_if:type,video|string|nullable',
			'content_quiz' =>
				$type === 'quiz' ? 'required|string|nullable' : 'nullable|string',
			'options' => 'required_if:type,quiz|array|min:2',
			'options.*.text' => 'required|string|max:255',
			'options.*.correct' => 'nullable',
		];

		$validated = $request->validate($rules);

		$stepType = $type === 'quiz' ? $quizType : $type;

		$content = match ($stepType) {
			'text' => $request->input('content_text'),
			'video' => $request->input('content_video'),
			default => $request->input('content_quiz'),
		};

		$position = $lesson->steps()->max('position') + 1;

		$step = $lesson->steps()->create([
			'question' => $validated['question'] ?? null,
			'type' => $stepType,
			'position' => $position,
			'content' => $content,
		]);

		if (in_array($stepType, ['quiz_single', 'quiz_multiple'])) {
			$options = $request->input('options', []);

			$hasCorrect = false;

			foreach ($options as $index => $opt) {
				$isCorrect = isset($opt['correct']) && $opt['correct'] ? true : false;
				if ($isCorrect) {
					$hasCorrect = true;
				}

				$step->options()->create([
					'text' => $opt['text'],
					'is_correct' => $isCorrect,
				]);
			}

			if (!$hasCorrect) {
				$step->options()->delete();
				$step->delete();

				return back()
					->withInput()
					->withErrors([
						'options_correct' =>
							'At least one option must be marked as correct.',
					]);
			}
		}

		return redirect()
			->route('teacher.lessons.steps.index', $lesson->id)
			->with('success', 'Step created successfully.');
	}

	public function create(Lesson $lesson)
	{
		return view('teacher.steps.create', compact('lesson'));
	}

	public function reorder(Request $request, Lesson $lesson)
	{
		$order = $request->input('order', []);
		try {
			foreach ($order as $item) {
				Step::where('id', $item['id'])
					->where('lesson_id', $lesson->id)
					->update(['position' => $item['position']]);
			}
			return response()->json(['status' => 'success']);
		} catch (\Exception $e) {
			return response()->json(
				['status' => 'error', 'message' => $e->getMessage()],
				500,
			);
		}
	}
}
