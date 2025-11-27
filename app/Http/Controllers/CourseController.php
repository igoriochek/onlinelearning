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

  public function show(Course $course)
  {
    $course->load(['sections.lessons.steps', 'reviews.user', 'ratings']);

    $firstLesson = $course->sections->flatMap->lessons->first();

    $progress = $this->progressService->getCourseProgress($course);

    $isAuthor = Auth::id() === $course->author_id;
    $isEnrolled = $course->students->contains(Auth::id());
    $reviewsWithRatings = $course->reviews->map(function ($review) use ($course) {
      $review->userRating = $course->ratings
        ->where('user_id', $review->user_id)
        ->first()?->rating;
      return $review;
    });

    return view('courses.show', compact(
      'course',
      'firstLesson',
      'progress',
      'isAuthor',
      'isEnrolled',
      'reviewsWithRatings'
    ));
  }
}
