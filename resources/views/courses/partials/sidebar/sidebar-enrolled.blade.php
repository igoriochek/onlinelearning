<div class="rounded-lg bg-gray-50 p-4 border border-gray-200 space-y-4">
  <h2 class="text-base font-semibold text-gray-800">{{ __('courses.continue_learning') }}</h2>

  <div class="space-y-1">
    <div
      class="w-full bg-gray-200 h-2 rounded-full"
      role="progressbar"
      aria-valuenow="{{ $progress['percent'] }}"
      aria-valuemin="0"
      aria-valuemax="100"
      aria-label="{{ __('courses.continue_learning') }}">
      <div
        class="bg-green-500 h-2 rounded-full transition-all"
        style="width: <?= $progress['percent'] ?>%"></div>
    </div>

    <p class="text-xs text-gray-500">
      {{ __('courses.tasks_completed', [
          'completed' => $progress['completed'],
          'total' => $progress['total'],
          'percent' => $progress['percent']
      ]) }}
    </p>

    @if(count($progress['notCorrect']))
    <p class="text-xs text-red-600">
      {{ __('courses.tasks_need_review', ['count' => count($progress['notCorrect'])]) }}
    </p>
    @endif
  </div>

  <x-primary-button
    :href="route('lessons.step.show', ['lesson' => $firstLesson->id, 'position' => 1])"
    class="w-full justify-center">
    {{ __('courses.continue') }}
  </x-primary-button>
  <x-wishlist-button :course="$course" variant="full" />
</div>