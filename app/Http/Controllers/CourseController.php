<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\ProgressService;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
	protected ProgressService $progressService;

	public function __construct(ProgressService $progressService)
	{
		$this->progressService = $progressService;
	}

	public function show(Course $course)
	{
		$course->load(['sections.lessons.steps', 'reviews.user']);

		$firstLesson = $course->sections->flatMap->lessons->first();

		$progress = $this->progressService->getCourseProgress($course);

		return view('courses.show', compact('course', 'firstLesson', 'progress'));
	}
}
