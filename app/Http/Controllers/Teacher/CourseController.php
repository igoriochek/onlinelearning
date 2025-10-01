<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
	public function create()
	{
		return view('teacher.courses.create');
	}

	public function store()
	{
		return view('teacher.courses.create');
	}

	// ...
}
