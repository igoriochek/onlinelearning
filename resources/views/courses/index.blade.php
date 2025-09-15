<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
			<div class="container">
				<h1 class="text-3xl font-semibold leading-tight text-gray-800">
					{{ $course->title }}
				</h1>
				<p class="text-gray-600 mt-1">
					{{ $course->description }}
				</p>
				<div class="flex items-center mt-2 gap-2">
					<span class="text-sm text-gray-500 capitalize">
						{{ $course->level_name }} Level
					</span>
				</div>
			</div>
			<div class="flex items-center">
				<div class="flex">
					@for ($i = 1; $i <= 5; $i++)
						<x-star :filled="$i <= round($course->averageRating)" />
					@endfor
				</div>
				<span class="ml-2 text-gray-600 text-sm">
					{{ $course->averageRating }}/5 ({{ $course->reviews->count() }}
					reviews)
				</span>
			</div>
		</div>
	</x-slot>

	<div
		class="max-w-6xl mx-auto py-6 grid grid-cols-1 md:grid-cols-3 gap-6 px-2"
	>
		<div class="md:col-span-2">
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
				<div class="mt-4 text-sm text-gray-600">
					<p>Video Lessons: {{ $course->video_lessons_count }}</p>
					<p>Text Lessons: {{ $course->text_lessons_count }}</p>
					<p>Quizzes: {{ $course->quizzes_count }}</p>
				</div>
			</div>
			<div class="mt-8">
				<h2 class="text-xl font-semibold mb-4">Student Reviews</h2>

				@forelse ($course->reviews as $review)
					<div class="border-b border-gray-200 pb-4 mb-4">
						<div class="flex items-center justify-between">
							<p class="font-semibold">{{ $review->user->name }}</p>
							<span class="text-sm text-gray-500">
								{{ $review->created_at->format('M d, Y') }}
							</span>
						</div>

						<div class="flex items-center mt-1">
							@for ($i = 1; $i <= 5; $i++)
								<x-star :filled="$i <= $review->rating" size="4" />
							@endfor
						</div>

						@if ($review->comment)
							<p class="mt-2 text-gray-700">{{ $review->comment }}</p>
						@endif
					</div>
				@empty
					<p class="text-gray-500">No reviews yet.</p>
				@endforelse
			</div>
		</div>
		<div class="hidden md:block md:col-span-1">
			<div class="md:sticky md:top-20 bg-white shadow rounded-lg p-6 space-y-2">
				<p class="text-2xl font-bold mb-2">${{ $course->price }}</p>
				<button class="bg-blue-600 text-white px-4 py-2 rounded mb-2 w-full">
					Buy now
				</button>
				<button class="border border-gray-300 px-4 py-2 rounded mb-2 w-full">
					Try free trial
				</button>
				@auth
					<form
						action="{{
        $course->isInWishlist()
        	? route('dashboard.wishlist.destroy', $course->id)
        	: route('dashboard.wishlist.store', $course->id)
      }}"
						method="POST"
						class="mt-2"
					>
						@csrf
						@if ($course->isInWishlist())
							@method('DELETE')
							<button
								class="text-red-600 border border-gray-300 px-4 py-2 rounded
									w-full"
							>
								Remove from Wishlist
							</button>
						@else
							<button class="border border-gray-300 px-4 py-2 rounded w-full">
								Add to Wishlist
							</button>
						@endif
					</form>
				@endauth
			</div>
		</div>
	</div>
	<div
		class="fixed bottom-0 left-0 w-full bg-white shadow-md p-2 flex flex-col
			md:hidden"
	>
		<span class="text-lg font-bold ml-2">${{ $course->price }}</span>
		<div class="flex gap-2 justify-between">
			<button class="bg-blue-600 text-white flex-1 py-2 mx-2 rounded">
				Buy
			</button>
			<div class="flex gap-2">
				@auth
					<form
						action="{{
        $course->isInWishlist()
        	? route('dashboard.wishlist.destroy', $course->id)
        	: route('dashboard.wishlist.store', $course->id)
      }}"
						method="POST"
					>
						@csrf
						@if ($course->isInWishlist())
							@method('DELETE')
						@endif

						<button
							type="submit"
							class="bg-gray-100 p-2 rounded flex items-center justify-center"
						>
							<x-hearth :filled="$course->isInWishlist()" size="5" />
						</button>
					</form>
				@endauth
			</div>
		</div>
	</div>
</x-app-layout>
