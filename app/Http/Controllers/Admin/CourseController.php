<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
  public function index()
  {
    $courses = Course::with('author')->withCount('enrollments')->get(10);

    return view('admin.courses.index', compact('courses'));
  }

  public function updateStatus(Request $request, Course $course)
  {
    $request->validate([
      'status' => 'required|in:pending,approved,rejected',
    ]);

    $course->status = $request->status;
    $course->save();

    return redirect()->back()->with('success', 'Course status updated.');
  }
}
