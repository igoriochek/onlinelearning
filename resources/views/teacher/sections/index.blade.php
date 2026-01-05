<x-app-layout>
  @section('title', $course->title . ' — ' . __('teacher.sections'))
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $course->title }} — {{ __('teacher.sections') }}
    </h2>
    <nav class="text-sm text-gray-700 mt-1">
      <a href="{{ route('teacher.courses.show', $course->id) }}"
        class="inline-block font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{ __('teacher.course_overview') }}
      </a>
      <span class="mx-1">/</span>
      <span>{{ __('teacher.sections') }}</span>
    </nav>
  </x-slot>

  <main
    x-data="{ sectionId: null, sectionTitle: '' }"
    class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">{{ __('teacher.sections') }}</h3>

        <x-primary-button @click="$dispatch('open-modal', 'create-section')">
          {{ __('teacher.add_section') }}
        </x-primary-button>
      </div>

      @if ($course->sections->isEmpty())
      <p class="text-gray-500">{{ __('teacher.no_sections_yet') }}</p>
      @else
      <div
        x-data="reorderItems('{{ route('teacher.courses.sections.reorder', $course->id) }}')"
        class="space-y-4">
        @foreach ($course->sections as $section)
        <div
          class="p-4 border rounded-lg space-y-4"
          data-id="{{ $section->id }}">
          <div
            class="flex flex-col sm:flex-row sm:items-center
									sm:justify-between gap-4">
            <div class="flex items-center gap-3">
              <div
                class="cursor-grab text-gray-400 hover:text-gray-600 pt-1">
                <x-icons.drag-handle />
              </div>
              <div>
                <span class="text-sm text-gray-500 font-semibold">
                  #{{ $section->position }}
                </span>
                <p
                  id="section-title-{{ $section->id }}"
                  class="text-base font-medium text-gray-900">
                  {{ $section->title }}
                </p>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
              <x-secondary-button
                href="{{ route('teacher.sections.lessons.index', $section->id) }}"
                class="w-full sm:w-auto justify-center">
                {{ __('teacher.manage_lessons') }}
              </x-secondary-button>

              <x-primary-button
                @click="
                    sectionId = {{ $section->id }};
                    sectionTitle = {{ json_encode($section->title) }};
                    $dispatch('open-modal', 'edit-section');"
                aria-label="Edit {{ $section->title }}"
                class="w-full sm:w-auto justify-center">
                {{ __('teacher.edit') }}
              </x-primary-button>

              <x-danger-button
                @click="
                  sectionId = {{ $section->id }};
                  $dispatch('open-modal', 'delete-section');"
                aria-label="Delete {{ $section->title }}"
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

    @include('teacher.sections.partials.delete-modal')
    @include('teacher.sections.partials.create-modal')
    @include('teacher.sections.partials.edit-modal')
  </main>
</x-app-layout>