<?php

namespace App\Http\Controllers\Teacher;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
	public function create()
	{
		return view('teacher.courses.create');
	}

	public function store(StoreCourseRequest $request): RedirectResponse
	{
		try {
			$data = $request->validated();

			if ($request->hasFile('image')) {
				$data['image_url'] = $request
					->file('image')
					->store('courses', 'public');
			}

			$data['author_id'] = Auth::id();

			$course = Course::create($data);

			return redirect()
				->route('teacher.courses.show', $course->id)
				->with(
					'success',
					'Course created successfully! You can now add sections, lessons and steps.',
				);
		} catch (Exception $e) {
			return back()->with('error', $e->getMessage());
		}
	}

	public function show(Course $course)
	{
		return view('teacher.courses.show', compact('course'));
	}

	public function destroy(Course $course)
	{
		$this->deleteCourseImage($course->image_url);

		$course->delete();

		return redirect()
			->route('dashboard.manage-courses')
			->with('success', 'Course deleted successfully.');
	}

	public function edit(Course $course)
	{
		return view('teacher.courses.edit', compact('course'));
	}

	public function update(StoreCourseRequest $request, Course $course)
	{
		$data = $request->validated();

		if ($request->hasFile('image')) {
			$this->deleteCourseImage($course->image_url);
			$data['image_url'] = $request->file('image')->store('courses', 'public');
		}

		$course->update($data);

		return redirect()
			->route('teacher.courses.show', $course)
			->with('success', 'Course updated successfully.');
	}

	public function publish(Course $course)
	{
		$course->load('sections.lessons.steps');

		if (!$course->is_completable) {
			return response()->json(
				[
					'error' =>
						'Course is incomplete. You must add sections, lessons and steps before publishing.',
				],
				422,
			);
		}

		$course->update(['public' => !$course->public]);
		return response()->json(['public' => $course->public]);
	}

	private function deleteCourseImage(?string $path): void
	{
		if ($path && Storage::disk('public')->exists($path)) {
			Storage::disk('public')->delete($path);
		}
	}
}
