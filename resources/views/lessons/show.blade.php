<x-app-layout>
  @section('title', $lesson->title . ' — Step ' . $step->position)
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $course->title }}
    </h2>
    <div class="text-sm mt-1">
      <a href="{{ route('courses.show', $course->id) }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{__('nav.back_course')}}
      </a>
    </div>
    @include('lessons.partials.lesson-topbar', ['lesson' => $lesson, 'step' => $step])
  </x-slot>

  <div
    class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 py-6 px-2">
    @include('lessons.partials.lesson-sidebar', ['course' => $course, 'lesson' => $lesson])
    <section
      class="md:col-span-3 bg-white shadow rounded-lg p-6"
      x-data="stepCompletion(
           	{{ $step->id }},
           	{{ in_array($step->type, ['text', 'video']) ? 1 : 0 }},
           	{{ $isCompleted ? 'true' : 'false' }},
           )">
      @if ($step->type === 'text')
      <x-steps.text :step="$step" />
      @elseif ($step->type === 'video')
      <x-steps.video :step="$step" />
      @elseif ($step->type === 'quiz_code')
      <x-steps.quiz-code :step="$step" />
      @elseif (in_array($step->type, ['quiz_single', 'quiz_multiple']))
      <x-steps.quiz
        :step="$step"
        :type="$step->type === 'quiz_multiple' ? 'multiple' : 'single'" />
      @endif
    </section>
    <div class="md:col-span-4 w-full flex justify-end px-2 md:px-0">
      <div class="flex gap-2">
        @if ($prevStepRoute)
        <x-secondary-button
          type="button"
          onclick="window.location=`{{ route('lessons.step.show', $prevStepRoute) }}`">
          Previous
        </x-secondary-button>
        @endif

        @if ($nextStepRoute)
        <x-secondary-button
          type="button"
          onclick="window.location=`{{ route('lessons.step.show', $nextStepRoute) }}`">
          next
        </x-secondary-button>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>