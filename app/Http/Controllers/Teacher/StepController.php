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

	public function create(Lesson $lesson)
	{
		return view('teacher.steps.create', compact('lesson'));
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
			'content_video' => [
				'required_if:type,video',
				'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/',
			],
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

		$options = $validated['options'] ?? [];

		if (in_array($stepType, ['quiz_single', 'quiz_multiple'])) {
			$this->ensureAtLeastOneCorrectOption($options);
		}

		$position = $lesson->steps()->max('position') + 1;

		$step = $lesson->steps()->create([
			'question' => $validated['question'] ?? null,
			'type' => $stepType,
			'position' => $position,
			'content' => $content,
		]);

		if (in_array($stepType, ['quiz_single', 'quiz_multiple'])) {
			foreach ($options as $opt) {
				$step->options()->create([
					'text' => $opt['text'],
					'is_correct' => !empty($opt['correct']),
				]);
			}
		}

		return redirect()
			->route('teacher.lessons.steps.index', $lesson->id)
			->with('success', 'Step created successfully.');
	}

	public function edit(Step $step)
	{
		$lesson = $step->lesson;
		return view('teacher.steps.edit', compact('step', 'lesson'));
	}

	public function update(Request $request, Step $step)
	{
		switch ($step->type) {
			case 'text':
				$this->updateTextStep($request, $step);
				break;
			case 'video':
				$this->updateVideoStep($request, $step);
				break;
			case 'quiz_single':
			case 'quiz_multiple':
				$this->updateQuizStep($request, $step);
				break;
		}

		return redirect()
			->route('teacher.lessons.steps.index', $step->lesson_id)
			->with('success', 'Step updated successfully.');
	}

	protected function updateTextStep(Request $request, Step $step): void
	{
		$validated = $request->validate([
			'content_text' => 'required|string',
		]);

		$step->update([
			'content' => $validated['content_text'],
		]);
	}

	protected function updateVideoStep(Request $request, Step $step): void
	{
		$validated = $request->validate([
			'content_video' => [
				'required',
				'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/',
			],
		]);

		$step->update([
			'content' => $validated['content_video'],
		]);
	}

	protected function updateQuizStep(Request $request, Step $step): void
	{
		$validated = $request->validate([
			'content_quiz' => 'required|string',
			'question' => 'required|string',
			'quiz_type' => 'required|in:quiz_single,quiz_multiple',
			'options' => 'required|array|min:2',
			'options.*.text' => 'required|string',
			'options.*.correct' => 'nullable',
		]);
		$this->ensureAtLeastOneCorrectOption($validated['options']);

		$step->update([
			'type' => $validated['quiz_type'],
			'content' => $validated['content_quiz'],
			'question' => $validated['question'],
		]);

		$this->syncQuizOptions($step, $validated['options']);
	}

	protected function syncQuizOptions(Step $step, array $options): void
	{
		$existingOptions = $step->options()->get()->keyBy('id');
		$receivedIds = [];

		foreach ($options as $optionData) {
			$id = $optionData['id'] ?? null;
			$isCorrect = !empty($optionData['correct']);

			if ($id && $existingOptions->has($id)) {
				$existingOptions[$id]->update([
					'text' => $optionData['text'],
					'is_correct' => $isCorrect,
				]);

				$receivedIds[] = $id;
			} else {
				$newOption = $step->options()->create([
					'text' => $optionData['text'],
					'is_correct' => $isCorrect,
				]);

				$receivedIds[] = $newOption->id;
			}
		}

		$step->options()->whereNotIn('id', $receivedIds)->delete();
	}

	protected function ensureAtLeastOneCorrectOption(array $options): void
	{
		if (!collect($options)->contains(fn($opt) => !empty($opt['correct']))) {
			back()
				->withInput()
				->withErrors([
					'options_correct' => 'At least one option must be marked as correct.',
				])
				->throwResponse();
		}
	}

	public function destroy(Step $step)
	{
		$course = $step->lesson->section->course;
		$step->delete();

		if ($course->public) {
			$course->update(['public' => false]);
		}

		return back()->with('success', 'Step deleted successfully');
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
