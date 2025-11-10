<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
	public function store(Course $course)
	{
		$user = Auth::user();

		if ($course->author_id === $user->id) {
			return back()->with('error', 'You cannot buy your own course.');
		}

		$alreadyEnrolled = Enrollment::where('user_id', $user->id)
			->where('course_id', $course->id)
			->exists();

		if ($alreadyEnrolled) {
			return back()->with('info', 'You are already enrolled in this course.');
		}

		Enrollment::create([
			'user_id' => $user->id,
			'course_id' => $course->id,
			'purchased_at' => now(),
		]);

		return back()->with(
			'success',
			'You have successfully enrolled in the course!',
		);
	}
}
