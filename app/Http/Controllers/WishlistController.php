<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
	public function index()
	{
		$wishlists = Auth::user()->wishlist()->with('course')->get();

		return view('dashboard.wishlist', compact('wishlists'));
	}

	public function store(Request $request, Course $course)
	{
		Wishlist::firstOrCreate([
			'user_id' => Auth::id(),
			'course_id' => $course->id,
		]);

		return back()->with('success', 'Course added to wishlist!');
	}

	public function destroy(Course $course)
	{
		Wishlist::where('user_id', Auth::id())
			->where('course_id', $course->id)
			->delete();

		return back()->with('success', 'Course removed from wishlist!');
	}
}
