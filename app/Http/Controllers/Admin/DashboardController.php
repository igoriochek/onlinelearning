<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $recentUsers = User::latest()->take(5)->get();
    $recentReviews = Review::latest()->take(5)->with('user')->get();

    $registrations = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
      ->where('created_at', '>=', Carbon::now()->subDays(7))
      ->groupBy('date')
      ->orderBy('date')
      ->get();

    $chartLabels = $registrations->pluck('date');
    $chartData = $registrations->pluck('count');

    $topCourses = Course::withCount('enrollments')
      ->having('enrollments_count', '>', 0)
      ->orderByDesc('enrollments_count')
      ->take(5)
      ->get();

    $topCourseLabels = $topCourses->pluck('title')->toArray();
    $topCourseData = $topCourses->pluck('enrollments_count')->toArray();

    return view(
      'admin.dashboard.index',
      compact(
        'recentUsers',
        'recentReviews',
        'chartLabels',
        'chartData',
        'topCourseLabels',
        'topCourseData'
      )
    );
  }
}
