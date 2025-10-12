<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;

class SectionController extends Controller
{
	public function index(Course $course)
	{
		return view('teacher.sections.index', compact('course'));
	}
}
