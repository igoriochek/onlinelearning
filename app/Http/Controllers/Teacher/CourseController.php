<?php

namespace App\Http\Controllers\Teacher;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
}
