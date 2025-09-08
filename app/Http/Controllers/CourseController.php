<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
	public function index()
	{
		$courses = Course::all();
		return view('courses.index', compact('courses'));
	}

	public function show(Course $course)
	{
		$course->load(['sections.lessons.steps', 'reviews.user']);

		$averageRating = round($course->reviews()->avg('rating'), 1);

		$videoLessons = $course->sections
			->flatMap(fn($section) => $section->lessons)
			->flatMap(fn($lesson) => $lesson->steps)
			->where('type', 'video')
			->count();

		$textLessons = $course->sections
			->flatMap(fn($section) => $section->lessons)
			->flatMap(fn($lesson) => $lesson->steps)
			->where('type', 'text')
			->count();

		$quizzes = $course->sections
			->flatMap(fn($section) => $section->lessons)
			->flatMap(fn($lesson) => $lesson->steps)
			->where('type', 'quiz')
			->count();

		return view(
			'courses.show',
			compact(
				'course',
				'averageRating',
				'videoLessons',
				'textLessons',
				'quizzes',
			),
		);
	}
}
