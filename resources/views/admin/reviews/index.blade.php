<x-admin-layout>
  @section('title', __('admin.reviews'))
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('admin.reviews') }}
    </h2>
  </x-slot>
  <div class="py-6" x-data="{ reviewId: null, selectedReview: null}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="relative overflow-x-auto shadow rounded-lg border border-default">
        <table class="w-full text-sm text-left rtl:text-right">
          <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b font-medium ">
            <tr>
              <th class="px-6 py-3">
                {{ __('tables.user') }}
              </th>

              <th class="px-6 py-3">
                {{__('tables.course')}}
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
                {{ __('tables.comment') }}
              </th>

              <th class="px-6 py-3" data-sortable="text">
                <div class="flex items-center">
                  {{__('tables.status')}}
                  <a href="#" id="sortStatus">
                    <x-lucide-arrow-up-down class="w-4 h-4 ms-1" />
                  </a>
                </div>
              </th>

              <th class="px-6 py-3 text-right">
                {{__('tables.actions')}}
              </th>

            </tr>
          </thead>

          <tbody class="bg-white">
            @foreach ($reviews as $review)
            <tr class="border-b  border-default">
              <td class="px-6 py-4 whitespace-nowrap">{{ $review->user->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $review->course->title }}</td>
              <td class="px-10 py-4 whitespace-nowrap">
                @if($review->rating)
                <span class="text-yellow-500">{{ $review->rating }} ★</span>
                @else
                —
                @endif
              </td>
              <td class="px-6 py-4 max-w-xs truncate" title="{{ $review->comment }}">
                {{ $review->comment }}
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$review->status">{{ __('status.' . $review->status) }}</x-badge>
              </td>

              <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end items-center gap-3">
                  <button
                    @click="
                      selectedReview = {{ $review->toJson() }};
                      $dispatch('open-modal', 'moderate-review');
                    "
                    class="p-1 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition"
                    title="{{ __('actions.moderate_review') }}">
                    <x-lucide-eye class="w-5 h-5" />
                  </button>

                  <button
                    @click="reviewId = {{ $review->id }}; $dispatch('open-modal', 'delete-review');"
                    class="text-gray-500 hover:text-red-500 transition"
                    title="{{ __('actions.delete_review') }}">
                    <x-lucide-trash-2 class="w-5 h-5" />
                  </button>
                </div>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-4">
        {{ $reviews->links() }}
      </div>
    </div>
    @include('admin.reviews.partials.delete-modal')
    @include('admin.reviews.partials.moderate-modal')
  </div>
</x-admin-layout>