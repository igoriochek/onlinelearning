<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseSection extends Component
{
	public $title;
	public $courses;

	public function __construct($title, $courses)
	{
		$this->title = $title;
		$this->courses = $courses;
	}

	public function render()
	{
		return view('components.course-section');
	}
}
