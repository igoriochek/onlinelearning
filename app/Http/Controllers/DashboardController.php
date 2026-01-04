<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

    $courses = $user->courses()->latest()->paginate(9);
    return view('dashboard.manage-courses', compact('courses'));
  }
  public function myCourses()
  {
    /** @var User $user */
    $user = Auth::user();

    $courses = Course::whereHas('enrollments', function ($query) use ($user) {
      $query->where('user_id', $user->id);
    })
      ->latest()
      ->paginate(9);

    return view('dashboard.my-courses', compact('courses'));
  }
}
