@props(['reviews'])

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Reviews</h3>

  <ul class="divide-y divide-gray-100">
    @foreach ($reviews as $review)
    <li class="py-3 flex flex-col md:flex-row md:items-center md:justify-between gap-2 md:gap-4">
      <div class="flex-1 min-w-0">
        <p class="font-medium text-gray-900">{{ $review->user->name }}</p>
        <p class="text-sm text-gray-500 truncate max-w-xs w-full break-words">{{ $review->comment }}</p>
      </div>
      <div class="flex items-center gap-2 mt-1 md:mt-0">
        <x-badge :type="$review->status">{{ ucfirst($review->status) }}</x-badge>
        <span class="font-semibold {{ $review->rating ? 'text-yellow-500' : 'text-gray-400' }}">
          {{ $review->rating }} ★
        </span>

        <span class="text-sm text-gray-400">{{ $review->created_at->format('Y-m-d') }}</span>
      </div>
    </li>
    @endforeach
  </ul>
  <div class="text-right">
    <a href="{{ route('admin.reviews.index') }}" class="text-sm text-gray-500 hover:underline">
      See all reviews
    </a>
  </div>
</div>