<x-app-layout>
  @section('title', $course->title)
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $course->title }} — Overview
    </h2>
    <div class="text-sm mt-1">
      <a href="{{ route('dashboard.manage-courses') }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{__('nav.back_courses')}}
      </a>
    </div>
  </x-slot>

  <main x-data="{ courseId: null, courseTitle: '' }" class="max-w-7xl mx-auto py-6">
    <div class="bg-white p-6 rounded-lg shadow">
      <img
        src="{{ $course->image_url ? asset('storage/' . $course->image_url) : 'https://placehold.co/600x400?text=Course+Image' }}"
        alt="{{ $course->title }}"
        class="aspect-video w-full max-w-2xl object-cover rounded-lg mb-4"
        loading="lazy" />
      <p class="text-gray-700 mb-4">{{ $course->description }}</p>

      <div class="flex items-center justify-between border-t pt-4">
        <div class="flex flex-col sm:flex-row items-center gap-4">
          <x-input-label
            for="course-visibility"
            value="Make course public:"
            class="mb-1" />
          <x-switch
            id="course-visibility"
            :checked="$course->public"
            :action="route('teacher.courses.publish', $course->id)"
            :disabled="!$course->is_completable" />
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
          <x-danger-button
            @click="
        courseId = '{{ $course->id }}';
        courseTitle = '{{ $course->title }}';
        $dispatch('open-modal', 'delete-course');
    "
            class="w-full sm:w-auto justify-center">
            Delete Course
          </x-danger-button>
          <x-secondary-button :href="route('teacher.courses.edit', $course)">
            Edit course info
          </x-secondary-button>
          <x-primary-button
            :href="route('teacher.courses.sections.index', $course->id)">
            Manage Sections
          </x-primary-button>
        </div>
      </div>
    </div>
    @include('teacher.courses.partials.delete-modal')
  </main>
</x-app-layout>