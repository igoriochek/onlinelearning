<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\ProgressService;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
  protected ProgressService $progressService;

  public function __construct(ProgressService $progressService)
  {
    $this->progressService = $progressService;
  }

  public function index(Request $request)
  {
    $levels = [
      1 => 'beginner',
      2 => 'intermediate',
      3 => 'advanced',
    ];

    $courses = Course::query();

    if ($request->filled('level')) {
      $levelsFilter = array_intersect($request->level, array_keys($levels));
      if (!empty($levelsFilter)) {
        $courses->whereIn('level', $levelsFilter);
      }
    }

    $sort = $request->get('sort', 'title');

    switch ($sort) {
      case 'newest':
        $courses->orderByDesc('created_at');
        break;
      case 'best':
        $courses->withAvg(['reviews as avg_rating' => fn($q) => $q->where('status', 'approved')], 'rating')
          ->orderByDesc('avg_rating');
        break;
      case 'popular':
        $courses->withCount('enrollments')
          ->orderByDesc('enrollments_count');
        break;
      default:
        $courses->orderBy('title');
    }

    $courses = $courses->paginate(12)->withQueryString();

    return view('courses.index', compact('courses', 'levels'));
  }

  public function show(Course $course)
  {
    $course->load(['sections.lessons.steps']);

    $firstLesson = $course->sections->flatMap->lessons->first();
    $progress = $this->progressService->getCourseProgress($course);
    $isAuthor = $course->isAuthoredBy(Auth::user());
    $isEnrolled = $course->isEnrolled(Auth::user());
    $userReview = $course->reviewBy(Auth::user());

    return view('courses.show', compact(
      'course',
      'firstLesson',
      'progress',
      'isAuthor',
      'isEnrolled',
      'userReview',
    ));
  }
}
