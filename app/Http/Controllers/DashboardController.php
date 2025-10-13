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
}
