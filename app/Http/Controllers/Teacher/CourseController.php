<?php

namespace App\Http\Controllers\Teacher;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

      $course = Course::create($data);

      return redirect()
        ->route('teacher.courses.sections.index', $course->id)
        ->with(
          'success',
          __('toast.course.created_add_sections'),
        );
    } catch (Exception $e) {
      return back()->with('error', __('toast.course.create_failed'));
    }
  }

  public function show(Course $course)
  {
    return view('teacher.courses.show', compact('course'));
  }

  public function destroy(Course $course)
  {
    if (!$course->isAuthoredBy(Auth::user())) {
      abort(403, 'You are not authorized to delete this course.');
    }

    try {
      $this->deleteCourseImage($course->image_url);

      $course->delete();

      return redirect()
        ->route('dashboard.manage-courses')
        ->with('success', __('toast.course.deleted'));
    } catch (Exception $e) {
      return redirect()
        ->route('dashboard.manage-courses')
        ->with('error', __('toast.course.delete_failed'));
    }
  }

  public function edit(Course $course)
  {
    if (!$course->isAuthoredBy(Auth::user())) {
      abort(403, 'You are not authorized to edit this course.');
    }

    return view('teacher.courses.edit', compact('course'));
  }

  public function update(StoreCourseRequest $request, Course $course)
  {
    if (!$course->isAuthoredBy(Auth::user())) {
      abort(403, 'You are not authorized to update this course.');
    }

    $data = $request->validated();

    if ($request->hasFile('image')) {
      $this->deleteCourseImage($course->image_url);
      $data['image_url'] = $request->file('image')->store('courses', 'public');
    }

    $course->fill($data);
    try {
      if ($course->isDirty()) {
        $course->save();

        $course->markPending();

        return redirect()
          ->route('teacher.courses.show', $course)
          ->with('success', __('toast.course.updated'));
      }

      return redirect()
        ->route('teacher.courses.show', $course)
        ->with('info', __('toast.generic.no_changes'));
    } catch (Exception $e) {
      return back()->with('error', __('toast.course.update_failed'));
    }
  }

  public function publish(Course $course)
  {
    $course->load('sections.lessons.steps');

    if (!$course->is_completable) {
      return response()->json(
        [
          'error' =>
          __('toast.course.not_completable'),
        ],
        422,
      );
    }

    $course->update(['public' => !$course->public]);
    return response()->json(['public' => $course->public]);
  }

  private function deleteCourseImage(?string $path): void
  {
    if ($path && Storage::disk('public')->exists($path)) {
      Storage::disk('public')->delete($path);
    }
  }
}
