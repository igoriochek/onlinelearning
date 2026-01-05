<div class="rounded-lg bg-gray-50 p-4 border border-gray-200 space-y-4">
  <x-primary-button
    :href="route('teacher.courses.show', $course->id)"
    class="w-full justify-center">
    {{ __('courses.manage_course') }}
  </x-primary-button>

  <x-secondary-button
    :href="route('lessons.step.show', ['lesson' => $firstLesson->id, 'position' => 1])"
    class="w-full justify-center">
    {{__('courses.preview_student')}}
  </x-secondary-button>
</div>