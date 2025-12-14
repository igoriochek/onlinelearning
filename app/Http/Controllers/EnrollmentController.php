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

    if ($course->isAuthoredBy($user)) {
      return back()->with('error', 'You cannot enroll into your own course.');
    }

    if ($course->isEnrolled($user)) {
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
