<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Courses Management') }}
    </h2>
  </x-slot>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="relative overflow-x-auto shadow rounded-lg border border-default" x-data>
        <table class="w-full text-sm text-left rtl:text-right">
          <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b font-medium ">
            <tr>
              <th class="px-6 py-3">
                Title
              </th>

              <th class="px-6 py-3">
                Author
              </th>

              <th class="px-6 py-3">
                Level
              </th>

              <th class="px-6 py-3">
                Published
              </th>

              <th class="px-6 py-3">
                Status
              </th>

              <th class="px-6 py-3" data-sortable="number">
                <div class="flex items-center">
                  Avg. Rating
                  <a href="#" id="sortRating">
                    <x-lucide-arrow-up-down class="w-4 h-4 ms-1" />
                  </a>

                </div>
              </th>

              <th class="px-6 py-3">
                Students
              </th>

              <th class="px-6 py-3 text-right">
                Actions
              </th>

            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($courses as $course)
            <tr class="border-b">
              <td class="px-6 py-4 whitespace-nowrap">{{ $course->title }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $course->author->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $course->level_name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$course->public ? 'success' : 'default'">
                  {{ $course->public ? 'Published' : 'Unpublished' }}
                </x-badge>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$course->status">{{ ucfirst($course->status) }}</x-badge>
              </td>
              <td class="px-12 py-4 whitespace-nowrap">
                @if($course->averageRating)
                <span class="text-yellow-500">{{ $course->averageRating }} ★</span>
                @else
                —
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $course->enrollments_count }}</td>
              <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                @if($course->firstLesson)
                <div class="flex justify-end items-center gap-2">
                  <a href="{{ route('admin.courses.step.show', ['lesson' => $course->firstLesson, 'position' => 1]) }}"
                    class="p-1 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition"
                    title="Show course">
                    <x-lucide-eye class="w-5 h-5" />
                  </a>

                  <form action="{{ route('admin.courses.update-status', $course) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PATCH')

                    @if($course->status === 'pending')
                    <button type="submit" name="status" value="approved" title="Approve" class="text-gray-500 hover:text-green-600 rounded">
                      <x-lucide-check class="w-5 h-5" />
                    </button>
                    <button type="submit" name="status" value="rejected" title="Reject" class="text-gray-500 hover:text-red-600 rounded">
                      <x-lucide-x class="w-5 h-5" />
                    </button>
                    @elseif($course->status === 'approved')
                    <button type="submit" name="status" value="rejected" title="Reject" class="text-gray-500 hover:text-red-600 rounded">
                      <x-lucide-x class="w-5 h-5" />
                    </button>
                    @elseif($course->status === 'rejected')
                    <button type="submit" name="status" value="approved" title="Approve" class="text-gray-500 hover:text-green-600 rounded">
                      <x-lucide-check class="w-5 h-5" />
                    </button>
                    @endif
                  </form>
                </div>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-admin-layout>