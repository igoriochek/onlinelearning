<?php

namespace App\Http\Controllers\Teacher;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
	public function create()
	{
		return view('teacher.courses.create');
	}

	public function store(StoreCourseRequest $request): RedirectResponse
	{
		try {
			$data = $request->validated();

			if ($request->hasFile('image')) {
				$data['image_url'] = $request
					->file('image')
					->store('courses', 'public');
			}

			$data['author_id'] = Auth::id();

			Course::create($data);

			return redirect()
				->route('teacher.courses.create')
				->with('success', 'Course created successfuly.');
		} catch (Exception $e) {
			return back()->with('error', $e->getMessage());
		}
	}
}
