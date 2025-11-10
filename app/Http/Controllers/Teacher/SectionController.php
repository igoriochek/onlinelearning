<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
	public function index(Course $course)
	{
		return view('teacher.sections.index', compact('course'));
	}

	public function store(Request $request, Course $course)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		]);

		if ($course->public) {
			$course->update(['public' => false]);
		}

		$course->sections()->create([
			'title' => $request->title,
			'position' => $course->sections()->max('position') + 1,
		]);

		return redirect()
			->route('teacher.courses.sections.index', $course->id)
			->with('success', 'Section created successfully!');
	}

	public function update(Request $request, Section $section)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		]);

		$section->update([
			'title' => $request->title,
		]);

		return response()->json([
			'id' => $section->id,
			'title' => $section->title,
		]);
	}

	public function destroy(Section $section)
	{
		$course = $section->course;
		$section->delete();

		if ($course->public) {
			$course->update(['public' => false]);
		}

		return back()->with('success', 'Section deleted successfully!');
	}

	public function reorder(Request $request, Course $course)
	{
		$order = $request->input('order', []);

		try {
			foreach ($order as $item) {
				Section::where('id', $item['id'])
					->where('course_id', $course->id)
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
