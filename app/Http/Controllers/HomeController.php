<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
	public function index()
	{
		$recentCourses = Course::orderBy('created_at', 'desc')->take(6)->get();
		return view('home.index', compact('recentCourses'));
	}
}
