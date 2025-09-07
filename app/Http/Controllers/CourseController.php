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
		$course->load('sections.lessons.steps');

		$videoLessons = 0;
		$textLessons = 0;
		$quizzes = 0;

		foreach ($course->sections as $section) {
			foreach ($section->lessons as $lesson) {
				foreach ($lesson->steps as $step) {
					switch ($step->type) {
						case 'video':
							$videoLessons++;
							break;
						case 'text':
							$textLessons++;
							break;
						case 'quiz':
							$quizzes++;
							break;
					}
				}
			}
		}

		return view(
			'courses.show',
			compact('course', 'videoLessons', 'textLessons', 'quizzes'),
		);
	}
}
