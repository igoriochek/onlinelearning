<x-app-layout>
	<x-slot name="header">
    <div class="flex justify-between"><h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $course->title }}
		</h2>
    <div class="flex items-center">
      <div class="flex mb-1">
       @for ($i = 1; $i <= 5; $i++)
            <x-star :filled="$i <= round($averageRating)" />
        @endfor
        </div>
        <span class="ml-2 text-gray-600 text-sm">
        {{ $averageRating }}/5 ({{ $course->reviews->count() }} reviews)
    </span>
    </div>
    
</div>
    
	</x-slot>

	<div class="max-w-6xl mx-auto py-6 grid grid-cols-3 gap-6">
		<div class="col-span-2">
			<img
				src="{{ $course->image_url }}"
				alt="{{ $course->title }}"
				class="rounded-lg mb-4"
			/>

			<div class="mb-6">
				<h2 class="text-xl font-semibold mb-2">What you'll learn</h2>
				<ul class="list-disc ml-6">
					@foreach ($course->sections as $section)
						<li>{{ $section->title }}</li>
					@endforeach
				</ul>
			</div>

			<div class="mb-6">
				<h2 class="text-xl font-semibold mb-2">About this course</h2>
				<p>{{ $course->description }}</p>
			</div>

			<div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Meet the instructor</h2>
					<p>{{ $course->author->name }}</p>
			</div>

			<div class="mb-6">
				<h2 class="text-xl font-semibold mb-2">How you will learn</h2>
				<ol class="list-decimal ml-6">
					@foreach ($course->sections as $section)
						<li>
							{{ $section->title }} ({{ $section->lessons->count() }} lessons)
						</li>
					@endforeach
				</ol>
			</div>

		<div>
			<div class="bg-white shadow rounded-lg p-6 sticky top-6">
				<p class="text-2xl font-bold mb-2">${{ $course->price }}</p>
				<button class="bg-blue-600 text-white px-4 py-2 rounded mb-2 w-full">
					Buy now
				</button>
				<button class="border border-gray-300 px-4 py-2 rounded mb-2 w-full">
					Try free trial
				</button>
				<button class="border border-gray-300 px-4 py-2 rounded w-full">
					Add to Wishlist
				</button>

				<div class="mt-4 text-sm text-gray-600">
        <p>Video Lessons: {{ $videoLessons }}</p>
        <p>Text Lessons: {{ $textLessons }}</p>
         <p>Quizzes: {{ $quizzes }}</p>
        </div>
			</div>
      <div class="mt-8">
    <h2 class="text-xl font-semibold mb-4">Student Reviews</h2>

    @forelse($course->reviews as $review)
        <div class="border-b border-gray-200 pb-4 mb-4">
            <div class="flex items-center justify-between">
                <p class="font-semibold">{{ $review->user->name }}</p>
                <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
            </div>

            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.785.57-1.84-.197-1.54-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.048 9.402c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.975z"/>
                    </svg>
                @endfor
            </div>

            @if($review->comment)
                <p class="mt-2 text-gray-700">{{ $review->comment }}</p>
            @endif
        </div>
    @empty
        <p class="text-gray-500">No reviews yet.</p>
    @endforelse
</div>
		</div>
	</div>
</x-app-layout>
