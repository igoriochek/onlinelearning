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
    $courses = Course::with('author')->withCount('enrollments')->paginate(20);

    return view('admin.courses.index', compact('courses'));
  }

  public function approve(Course $course)
  {
    if ($course->status !== 'pending') {
      return back()->with('error', 'Only pending courses can be approved.');
    }

    $course->update(['status' => 'approved']);

    return back()->with('success', 'Course approved successfully.');
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
      return back()->with('warning', 'Course rejected, but notification was not sent.');
    }

    return back()->with('success', 'Course rejected and author notified.');
  }
}
