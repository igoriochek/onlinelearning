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
      return back()->with('error', __('toast.enrollment.self_enroll'));
    }

    if ($course->isEnrolled($user)) {
      return back()->with('info', __('toast.enrollment.already_enrolled'));
    }

    Enrollment::create([
      'user_id' => $user->id,
      'course_id' => $course->id,
      'purchased_at' => now(),
    ]);

    return back()->with(
      'success',
      __('toast.enrollment.success'),
    );
  }
}
