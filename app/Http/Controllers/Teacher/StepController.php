<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Lesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StepController extends Controller
{
	public function index(Lesson $lesson)
	{
		return view('teacher.steps.index', compact('lesson'));
	}
}
