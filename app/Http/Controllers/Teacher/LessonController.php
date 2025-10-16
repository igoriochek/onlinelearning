<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Section;
use App\Models\Lesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
	public function index(Section $section)
	{
		return view('teacher.lessons.index', compact('section'));
	}

	public function store(Request $request, Section $section)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		]);

		$section->lessons()->create([
			'title' => $request->title,
			'order' => $section->lessons()->count() + 1,
		]);

		return redirect()
			->route('teacher.lessons.index', $section->id)
			->with('success', 'Lesson created successfully!');
	}

	public function update(Request $request, Lesson $lesson)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		]);

		$lesson->update([
			'title' => $request->title,
		]);

		return response()->json([
			'id' => $lesson->id,
			'title' => $lesson->title,
		]);
	}

	public function destroy(Lesson $lesson)
	{
		$lesson->delete();

		return redirect()
			->route('teacher.lessons.index', $lesson->section_id)
			->with('success', 'Lesson deleted successfully!');
	}
}
