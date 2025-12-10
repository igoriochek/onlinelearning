<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Reviews') }}
    </h2>
  </x-slot>
  <div class="py-6" x-data="{ reviewId: null, selectedReview: null}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="relative overflow-x-auto shadow rounded-lg border border-default">
        <table class="w-full text-sm text-left rtl:text-right">
          <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b font-medium ">
            <tr>
              <th class="px-6 py-3">
                User
              </th>

              <th class="px-6 py-3">
                Course
              </th>

              <th class="px-6 py-3" data-sortable="number">
                <div class="flex items-center">
                  Rating
                  <a href="#" id="sortRating">
                    <x-lucide-arrow-up-down class="w-4 h-4 ms-1" />
                  </a>
                </div>
              </th>

              <th class="px-6 py-3">
                Comment
              </th>

              <th class="px-6 py-3" data-sortable="text">
                <div class="flex items-center">
                  Status
                  <a href="#" id="sortStatus">
                    <x-lucide-arrow-up-down class="w-4 h-4 ms-1" />
                  </a>
                </div>
              </th>

              <th class="px-6 py-3 text-right">
                Actions
              </th>

            </tr>
          </thead>

          <tbody class="bg-white">
            @foreach ($reviews as $review)
            <tr class="border-b  border-default">
              <td class="px-6 py-4 whitespace-nowrap">{{ $review->user->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $review->course->title }}</td>
              <td class="px-12 py-4 whitespace-nowrap">{{ $review->rating }}</td>
              <td class="px-6 py-4 max-w-xs truncate" title="{{ $review->comment }}">
                {{ $review->comment }}
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <x-badge :type="$review->status">{{ ucfirst($review->status) }}</x-badge>
              </td>

              <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end items-center gap-3">
                  <button
                    @click="
                      selectedReview = {{ $review->toJson() }};
                      $dispatch('open-modal', 'moderate-review');
                    "
                    class="p-1 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition"
                    title="Moderate review">
                    <x-lucide-eye class="w-5 h-5" />
                  </button>

                  <button
                    @click="reviewId = {{ $review->id }}; $dispatch('open-modal', 'delete-review');"
                    class="text-gray-500 hover:text-red-500 transition"
                    title="Delete review">
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