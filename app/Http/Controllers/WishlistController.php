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
		/** @var \App\Models\User $user */
		$user = Auth::user();

		$wishlists = $user->wishlist()->with('course')->get();

		$courses = $wishlists->pluck('course');

		return view('dashboard.wishlist', compact('courses'));
	}

	public function store(Request $request, Course $course)
	{
		Wishlist::firstOrCreate([
			'user_id' => Auth::id(),
			'course_id' => $course->id,
		]);

		return response()->json(['success' => true]);
	}

	public function destroy(Course $course)
	{
		Wishlist::where('user_id', Auth::id())
			->where('course_id', $course->id)
			->delete();

		return response()->json(['success' => true]);
	}
}
