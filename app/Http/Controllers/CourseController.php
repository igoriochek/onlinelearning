<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
	public function show(Course $course)
	{
		$user = Auth::user();
		if (
			!$course->public &&
			(!$user || ($user->id !== $course->author_id && !$user->role === 'admin'))
		) {
			abort(404);
		}

		$course->load(['sections.lessons.steps', 'reviews.user']);
		$firstLesson = $course->sections->flatMap->lessons->first();

		return view('courses.show', compact('course', 'firstLesson'));
	}
}
