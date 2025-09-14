<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseCard extends Component
{
	public Course $course;
	public bool $isInWishlist;
	/**
	 * Create a new component instance.
	 */
	public function __construct(Course $course)
	{
		$this->course = $course;

		/** @var \App\Models\User $user */
		$user = Auth::user();

		$this->isInWishlist = $user
			? $user->wishlist()->where('course_id', $course->id)->exists()
			: false;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.course-card');
	}
}
