<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
  public function index()
  {
    $courses = Course::with('author')->withCount('enrollments')->paginate(20);

    return view('admin.courses.index', compact('courses'));
  }

  public function updateStatus(Request $request, Course $course)
  {
    $request->validate([
      'status' => 'required|in:pending,approved,rejected',
    ]);

    try {
      $course->status = $request->status;
      $course->save();

      return redirect()->back()->with('success', 'Course status updated.');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Failed to update course status.');
    }
  }
}
