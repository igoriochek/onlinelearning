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

		$course->sections()->create([
			'title' => $request->title,
			'order' => $course->sections()->count() + 1,
		]);

		return redirect()
			->route('teacher.sections.index', $course->id)
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

	public function destroy($sectionId)
	{
		$section = Section::findOrFail($sectionId);
		$section->delete();

		return back()->with('success', 'Section deleted succesfully');
	}
}
