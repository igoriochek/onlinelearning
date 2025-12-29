<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
  public function store(Request $request, Course $course)
  {
    $request->validate([
      'comment' => 'required|string|max:1000',
      'rating' => 'nullable|integer|max:5'
    ]);

    Review::updateOrCreate(
      [
        'user_id' => Auth::id(),
        'course_id' => $course->id
      ],
      [
        'comment' => $request->comment,
        'rating' => $request->rating,
      ]
    );

    return redirect()->route('courses.show', $course->id)
      ->with('success', __('toast.review.submitted'));
  }

  public function destroy(Review $review)
  {
    $review->delete();

    return back()->with('success', __('toast.review.deleted_own'));
  }
}
