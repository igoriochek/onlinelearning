<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Section;
use App\Models\Lesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
  public function index(Section $section)
  {
    return view('teacher.lessons.index', compact('section'));
  }

  public function store(Request $request, Section $section)
  {
    $request->validate([
      'title' => 'required|string|max:255',
    ]);

    $course = $section->course;

    if ($course->public) {
      $course->update(['public' => false]);
    }

    $course->markPending();

    $section->lessons()->create([
      'title' => $request->title,
      'position' => $section->lessons()->max('position') + 1,
    ]);

    return redirect()
      ->route('teacher.sections.lessons.index', $section->id)
      ->with('success', 'Lesson created successfully!');
  }

  public function update(Request $request, Lesson $lesson)
  {
    $request->validate([
      'title' => 'required|string|max:255',
    ]);

    $lesson->update([
      'title' => $request->title,
    ]);

    $lesson->section->course->markPending();

    return response()->json([
      'id' => $lesson->id,
      'title' => $lesson->title,
    ]);
  }

  public function destroy(Lesson $lesson)
  {
    try {
      $course = $lesson->section->course;
      $lesson->delete();

      if ($course->public) {
        $course->update(['public' => false]);
      }

      $course->markPending();

      return back()->with('success', 'Lesson deleted successfully!');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete lesson. Please try again.');
    }
  }

  public function reorder(Request $request, Section $section)
  {
    $order = $request->input('order', []);

    try {
      foreach ($order as $item) {
        Lesson::where('id', $item['id'])
          ->where('section_id', $section->id)
          ->update(['position' => $item['position']]);
      }

      return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
      return response()->json(
        ['status' => 'error', 'message' => $e->getMessage()],
        500,
      );
    }
  }
}
