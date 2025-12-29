<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
  public function index()
  {
    $reviews = Review::with(['course', 'user'])
      ->latest()
      ->paginate(20);

    return view('admin.reviews.index', compact('reviews'));
  }

  public function update(Request $request, Review $review)
  {
    $request->validate([
      'status' => 'required|in:approved,rejected',
    ]);

    $review->fill($request->only('status'));

    try {
      if ($review->isDirty()) {
        $review->save();

        return redirect()->route('admin.reviews.index')
          ->with('success', __('toast.review.status_updated'));
      }

      return redirect()->route('admin.reviews.index')
        ->with('info', __('toast.generic.no_changes'));
    } catch (\Exception $e) {
      return redirect()->route('admin.reviews.index')
        ->with('error', __('toast.review.update_failed'));
    }
  }

  public function destroy(Review $review)
  {
    try {
      $review->delete();

      return redirect()->route('admin.reviews.index')
        ->with('success', __('toast.review.deleted'));
    } catch (\Exception $e) {
      return redirect()->route('admin.reviews.index')
        ->with('error', __('toast.review.delete_failed'));
    }
  }
}
