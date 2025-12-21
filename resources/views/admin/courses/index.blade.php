<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('admin.courses.title') }}
    </h2>
  </x-slot>
  <div class="py-6" x-data="{ courseId: null}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="relative overflow-x-auto shadow rounded-lg border border-default">
        <table class="w-full text-sm text-left rtl:text-right">
          <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b font-medium ">
            <tr>
              <th class="px-4 py-3">
                {{ __('tables.title') }}
              </th>

              <th class="px-6 py-3">
                {{ __('tables.author') }}
              </th>

              <th class="px-6 py-3">
                {{__('tables.published')}}
              </th>

              <th class="px-6 py-3">
                {{__('tables.status')}}
              </th>

              <th class="px-6 py-3" data-sortable="number">
                <div class="flex items-center">
                  {{__('tables.rating')}}
                  <a href="#" id="sortRating">
                    <x-lucide-arrow-up-down class="w-4 h-4 ms-1" />
                  </a>

                </div>
              </th>

              <th class="px-6 py-3">
                {{__('tables.students')}}
              </th>


              <th class="px-6 py-3">
                {{__('tables.last_updated')}}
              </th>

              <th class="px-6 py-3 text-right">
                {{__('tables.actions')}}
              </th>


            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($courses as $course)
            <tr class="border-b">
              <td class="px-4 py-4 whitespace-nowrap">{{ $course->title }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $course->author->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$course->public ? 'success' : 'default'">
                  {{ $course->public
                      ? __('status.published')
                      : __('status.unpublished')
                  }}
                </x-badge>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$course->status">{{ __('status.' . $course->status) }}</x-badge>
              </td>
              <td class="px-12 py-4 whitespace-nowrap">
                @if($course->averageRating)
                <span class="text-yellow-500">{{ $course->averageRating }} ★</span>
                @else
                —
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $course->enrollments_count }}</td>
              <td class="px-6 py-5 whitespace-nowrap">{{ $course->updated_at->diffForHumans() }}</td>
              <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                @if($course->firstLesson)
                <div class="flex justify-end items-center gap-2">
                  <a href="{{ route('admin.courses.step.show', ['lesson' => $course->firstLesson, 'position' => 1]) }}"
                    class="p-1 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition"
                    title="{{ __('actions.view') }}">
                    <x-lucide-eye class="w-5 h-5" />
                  </a>
                  @if($course->status === 'pending')
                  <form action="{{ route('admin.courses.approve', $course) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <button type="submit" title="{{ __('actions.approve') }}" class="text-gray-500 hover:text-green-600 rounded">
                      <x-lucide-check class="w-5 h-5" />
                    </button>
                    @method('PATCH')
                  </form>
                  @endif
                  @if($course->status != 'rejected')
                  <button
                    @click="courseId = '{{ $course->id }}'; $dispatch('open-modal', 'reject-course')"
                    class="text-gray-500 hover:text-red-600 rounded"
                    title="{{ __('actions.reject') }}">
                    <x-lucide-x class="w-5 h-5" />
                  </button>
                  @endif
                </div>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-4">
        {{ $courses->links() }}
      </div>
    </div>
    @include('admin.courses.partials.reject-modal')
  </div>
</x-admin-layout>