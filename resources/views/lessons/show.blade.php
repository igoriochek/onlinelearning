<x-app-layout>
  @section('title', $lesson->title . ' — Step ' . $step->position)
  @include('lessons.partials.lesson-topbar', ['lesson' => $lesson, 'step' => $step])
  <main
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
  </main>
</x-app-layout>