<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Http\Controllers\Controller;
use App\Services\StepService;

class LessonController extends Controller
{

  public function show(Lesson $lesson, $position)
  {
    $lesson->load('section.course.sections.lessons.steps');
    $course = $lesson->section->course;

    $step = $lesson->steps()->where('position', $position)->firstOrFail();

    $prevStepRoute = StepService::getStepRoute($step, 'prev');
    $nextStepRoute = StepService::getStepRoute($step, 'next');

    return view(
      'admin.lessons.show',
      compact(
        'course',
        'lesson',
        'step',
        'prevStepRoute',
        'nextStepRoute',
      )
    );
  }
}
