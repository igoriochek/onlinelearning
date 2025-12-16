<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
  public function index()
  {
    $baseQuery = Course::where('public', true)
      ->where('status', 'approved');

    $recentCourses = (clone $baseQuery)
      ->orderBy('created_at', 'desc')
      ->take(3)
      ->get();

    $popularCourses = Course::with('reviews')
      ->where('public', true)
      ->where('status', 'approved')
      ->get()
      ->sortByDesc(fn($course) => $course->averageRating)
      ->take(3);

    $beginnerCourses = (clone $baseQuery)
      ->where('level', '1')
      ->take(3)
      ->get();

    $intermediateCourses = (clone $baseQuery)
      ->where('level', '2')
      ->take(3)
      ->get();

    $advancedCourses = (clone $baseQuery)
      ->where('level', '3')
      ->take(3)
      ->get();

    return view('home.index', compact(
      'recentCourses',
      'popularCourses',
      'beginnerCourses',
      'intermediateCourses',
      'advancedCourses'
    ));
  }
}
