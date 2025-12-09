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

    $review->status = $request->status;
    $review->save();

    return redirect()->route('admin.reviews.index')
      ->with('success', 'Review updated successfully.');
  }

  public function destroy(Review $review)
  {
    $review->delete();
    return redirect()->route('admin.reviews.index')
      ->with('success', 'Review deleted successfully.');
  }
}
