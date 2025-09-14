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

		return view('courses.show', compact('course'));
	}
}
