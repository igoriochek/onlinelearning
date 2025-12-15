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
          ->with('success', 'Review updated successfully.');
      }

      return redirect()->route('admin.reviews.index')
        ->with('info', 'No updates were applied.');
    } catch (\Exception $e) {
      return redirect()->route('admin.reviews.index')
        ->with('error', 'Failed to update review.');
    }
  }

  public function destroy(Review $review)
  {
    try {
      $review->delete();
      return redirect()->route('admin.reviews.index')
        ->with('success', 'Review deleted successfully.');
    } catch (\Exception $e) {
      return redirect()->route('admin.reviews.index')
        ->with('error', 'Failed to delete review.');
    }
  }
}
