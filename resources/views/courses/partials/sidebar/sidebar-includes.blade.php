<div class="text-sm text-gray-700 space-y-3">
  <div class="border-t border-gray-200 pt-6 mt-6"></div>
  <h2 class="text-lg font-semibold">{{__('courses.includes')}}</h2>

  <p>
    <strong>{{ $course->lesson_count }}</strong>
    {{ __('courses.lessons') }}
  </p>

  <p>
    <strong>{{ $course->quizzes_count }}</strong>
    {{ __('courses.quizzes') }}
  </p>

  <p class="italic">{{ __('courses.last_update', ['date' => $course->updated_at->format('Y/m/d')]) }}</p>
</div>