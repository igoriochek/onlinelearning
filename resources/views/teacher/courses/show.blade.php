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
      <div class="flex flex-col lg:flex-row gap-6">
        <img
          src="{{ $course->image_url ? asset('storage/' . $course->image_url) : 'https://placehold.co/600x400?text=Course+Image' }}"
          alt="{{ $course->title }}"
          class="aspect-video w-full lg:w-2/3 object-cover rounded-lg" />

        <div class="lg:w-1/3 flex flex-col gap-4">
          <div class="flex flex-wrap gap-2">
            @if ($course->reviewsWithRating->count() > 0)
            <div class="flex items-center" aria-label="Course rating">
              <x-rating :value="$course->averageRating" />
              <span class="ml-2 text-gray-600 text-sm">
                {{ $course->averageRating }}/5 ({{ $course->reviewsWithRating->count() }}
                votes)
              </span>
            </div>
            @endif
            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
              Total Students: {{ $students->count() }}
            </span>
          </div>

          @if($students->count())
          <div class="bg-white shadow rounded-lg p-4 overflow-y-auto max-h-[400px]">
            <h3 class="text-sm font-semibold mb-2">Enrolled Students</h3>
            <table class="min-w-full divide-y divide-gray-200 text-sm">
              <thead class="bg-gray-50 text-xs">
                <tr>
                  <th class="px-2 py-1 text-left font-medium text-gray-500 uppercase">Name</th>
                  <th class="px-2 py-1 text-left font-medium text-gray-500 uppercase">Email</th>
                  <th class="px-2 py-1 text-left font-medium text-gray-500 uppercase">Progress</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach($students as $student)
                <tr>
                  <td class="px-2 py-1 text-gray-900">{{ $student['name'] }}</td>
                  <td class="px-2 py-1 text-gray-500">{{ $student['email'] }}</td>
                  <td class="px-2 py-1 text-gray-900">{{ $student['progress_percent'] ?? 0 }}%</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @endif
        </div>
      </div>
      <p class="text-gray-700 my-4">{{ $course->description }}</p>
      <div class="mb-4 border-t pt-4">
        @if($course->status === 'approved')
        <p class="text-green-600 text-sm font-medium">
          Your course has been approved
        </p>
        @elseif($course->status === 'pending')
        <p class="text-yellow-600 text-sm font-medium">
          Your course is pending admin approval
        </p>
        @elseif($course->status === 'rejected')
        <p class="text-red-600 text-sm font-medium">
          Your course has been rejected. Check your email for details
        </p>
        @endif
      </div>
      <div class="flex items-center justify-between">
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