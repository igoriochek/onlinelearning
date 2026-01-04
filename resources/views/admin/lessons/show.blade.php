<x-admin-layout>
  @section('title', $course->title . ' - Overview' )
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $course->title }} — Overview
    </h2>
    <div class="text-sm mt-1">
      <a href="{{ route('admin.courses.index') }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{__('nav.back_courses')}}
      </a>
    </div>

    @include('admin.lessons.partials.topbar')
  </x-slot>
  <div
    class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 py-2 px-2">
    @include('admin.lessons.partials.sidebar')
    <section
      class="md:col-span-3 bg-white shadow rounded-lg p-6">
      @if($step->type === 'text')
      <div class="prose max-w-none">
        {!! $step->content !!}
      </div>
      @elseif ($step->type === 'video')
      <x-steps.video :step="$step" />
      @elseif (in_array($step->type, ['quiz_single', 'quiz_multiple']))
      <div class="space-y-4">
        <div class="prose max-w-none">
          {!! $step->content !!}
        </div>

        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
          <p class="font-semibold text-gray-800">{{ $step->question }}</p>
          <div class="flex flex-col gap-2 mt-2">
            @foreach ($step->options as $option)
            <span class="block px-3 py-1 rounded-m text-gray-800">
              {{ $option->text }}
            </span>
            @endforeach
          </div>
        </div>
      </div>
      @endif
    </section>
    <div class="md:col-span-4 w-full flex justify-end px-2 md:px-0">
      <div class="flex gap-2">
        @if ($prevStepRoute)
        <x-secondary-button
          type="button"
          onclick="window.location=`{{ route('admin.courses.step.show', $prevStepRoute) }}`">
          {!! __('pagination.previous') !!}
        </x-secondary-button>
        @endif

        @if ($nextStepRoute)
        <x-secondary-button
          type="button"
          onclick="window.location=`{{ route('admin.courses.step.show', $nextStepRoute) }}`">
          {!! __('pagination.next') !!}
        </x-secondary-button>
        @endif
      </div>
    </div>
  </div>
</x-admin-layout>