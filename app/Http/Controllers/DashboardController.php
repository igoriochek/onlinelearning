<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
	public function index()
	{
		return view('dashboard.index');
	}

	public function manageCourses()
	{
		/** @var User $user */
		$user = Auth::user();

		$courses = $user->courses()->latest()->get();
		return view('dashboard.manage-courses', compact('courses'));
	}
	public function myCourses()
	{
		/** @var User $user */
		$user = Auth::user();

		$courses = $user
			->enrollments()
			->with('course')
			->latest('purchased_at')
			->get()
			->pluck('course');

		return view('dashboard.my-courses', compact('courses'));
	}
}
