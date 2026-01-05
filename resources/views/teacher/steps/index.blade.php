<x-app-layout>
  @section('title', $lesson->title . ' — ' . __('teacher.steps'))

  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $lesson->title }} — {{ __('teacher.steps') }}
    </h2>
    <nav class="text-sm text-gray-700 mt-1">
      <a href="{{ route('teacher.courses.show', $lesson->section->course_id) }}"
        class="inline-block font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{ __('teacher.course_overview') }}
      </a>
      <span class="mx-1">/</span>
      <a href="{{ route('teacher.courses.sections.index', $lesson->section->course_id) }}"
        class="inline-block font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{ __('teacher.sections') }}
      </a>
      <span class="mx-1">/</span>
      <a href="{{ route('teacher.sections.lessons.index', $lesson->section->id) }}"
        class="inline-block font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{ __('teacher.lessons') }}
      </a>
      <span class="mx-1">/</span>
      <span>{{ __('teacher.steps') }}</span>
    </nav>
  </x-slot>

  <main x-data="{ stepId: null }" class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">{{ __('teacher.lesson_steps') }}</h3>
        <x-primary-button
          href="{{ route('teacher.lessons.steps.create', $lesson->id) }}">
          {{ __('teacher.add_step') }}
        </x-primary-button>
      </div>
      @if ($lesson->steps->isEmpty())
      <p class="text-gray-500">{{ __('teacher.no_steps') }}</p>
      @else
      <div
        x-data="reorderItems('{{ route('teacher.lessons.steps.reorder', $lesson->id) }}')"
        class="space-y-4">
        @foreach ($lesson->steps as $step)
        <div
          class="p-4 border rounded-lg space-y-4"
          data-id="{{ $step->id }}">
          <div
            class="flex flex-col sm:flex-row sm:items-center
									sm:justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="cursor-grab text-gray-400 hover:text-gray-600">
                <x-icons.drag-handle />
              </div>
              <span class="font-semibold text-sm text-gray-500">
                #{{ $step->position }}
              </span>
              <x-steps.step-type :type="$step->type" />
            </div>
            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
              <x-primary-button
                href="{{ route('teacher.steps.edit', $step->id) }}"
                class="w-full sm:w-auto justify-center">
                {{ __('teacher.edit') }}
              </x-primary-button>
              <x-danger-button
                @click=" stepId = {{ $step->id }};
                  $dispatch('open-modal', 'delete-step');"
                class="w-full sm:w-auto justify-center">
                {{ __('teacher.delete') }}
              </x-danger-button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
    @include('teacher.steps.partials.delete-modal')
  </main>
</x-app-layout>