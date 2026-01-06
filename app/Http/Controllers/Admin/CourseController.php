<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Notifications\CourseRejected;
use Illuminate\Http\Request;

class CourseController extends Controller
{
  public function index()
  {
    $courses = Course::with('author')
      ->withCount('enrollments')
      ->orderByDesc('updated_at')
      ->paginate(20);

    return view('admin.courses.index', compact('courses'));
  }

  public function approve(Course $course)
  {
    if ($course->status !== 'pending') {
      return back()->with('error', __('toast.course.only_pending_can_be_approved'));
    }

    $course->update(['status' => 'approved']);

    return back()->with('success', __('toast.course.approved'));
  }

  public function reject(Request $request, Course $course)
  {
    $request->validate([
      'reason' => 'required|string|max:1000',
    ]);

    $course->update(['status' => 'rejected']);

    try {
      $course->author->notify(
        new CourseRejected($course->title, $request->reason)
      );
    } catch (\Throwable $e) {
      return back()->with('warning', __('toast.course.rejected_notification_failed'));
    }

    return back()->with('success', __('toast.course.rejected_and_notified'));
  }
}
