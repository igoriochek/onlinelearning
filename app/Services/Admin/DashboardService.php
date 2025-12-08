<?php

namespace App\Services\Admin;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Review;
use App\Models\User;

class DashboardService
{
  public function getDashboardData(): array
  {
    return array_merge(
      $this->getStats(),
      $this->getChartsData(),
      $this->getRecentData()
    );
  }

  private function getStats(): array
  {
    return [
      'totalUsers' => User::count(),
      'newUsersThisMonth' => User::whereMonth('created_at', now()->month)->count(),
      'activeUsersThisWeek' => User::where('last_login_at', '>=', now()->subWeek())->count(),
      'totalCourses' => Course::count(),
      'newCoursesThisMonth' => Course::whereMonth('created_at', now()->month)->count(),
      'enrollmentsThisMonth' => Enrollment::whereMonth('created_at', now()->month)->count(),
      'averageCourseRating' => Review::avg('rating'),
      'ratingsThisMonth' => Review::whereMonth('created_at', now()->month)->count(),
    ];
  }

  private function getChartsData(): array
  {
    $registrations = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
      ->where('created_at', '>=', now()->subDays(7))
      ->groupBy('date')
      ->orderBy('date')
      ->get();

    $topCourses = Course::withCount('enrollments')
      ->orderByDesc('enrollments_count')
      ->take(5)
      ->get();

    return [
      'chartLabels' => $registrations->pluck('date')->toArray(),
      'chartData' => $registrations->pluck('count')->toArray(),
      'topCourseLabels' => $topCourses->pluck('title')->toArray(),
      'topCourseData' => $topCourses->pluck('enrollments_count')->toArray(),
    ];
  }

  private function getRecentData(): array
  {
    return [
      'recentUsers' => User::latest()->take(5)->get(),
      'recentReviews' => Review::latest()->take(5)->with('user')->get(),
    ];
  }
}
