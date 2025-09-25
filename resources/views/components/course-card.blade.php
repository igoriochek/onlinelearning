<a href="{{ route('courses.show', $course->id) }}" class="block">
	<div
		class="bg-white shadow-sm rounded-lg overflow-hidden hover:shadow-md
			transition-shadow"
	>
		@if ($course->image_url)
			<img
				src="{{ $course->image_url }}"
				alt="{{ $course->title }}"
				class="w-full h-40 object-cover"
			/>
		@else
			<div
				class="w-full h-40 bg-gray-200 flex items-center justify-center
					text-gray-500"
			>
				No Image
			</div>
		@endif
		<div class="p-4">
			<h3 class="text-lg font-bold">{{ $course->title }}</h3>
			<p class="text-sm text-gray-600 line-clamp-2">
				{{ $course->description }}
			</p>

			@if ($course->averageRating)
				<div class="flex items-center mt-2">
					<x-star :filled="true" />
					<span class="ml-2 text-gray-600 text-sm mt-1">
						({{ $course->averageRating }})
					</span>
				</div>
			@endif

			<div class="mt-2 flex justify-between items-center">
				<span class="text-sm text-gray-500 capitalize">
					{{ $course->level_name }} Level
				</span>
				<span class="font-semibold text-green-600">${{ $course->price }}</span>
			</div>

			@auth
				<x-wishlist-button :course="$course" variant="text" />
			@endauth
		</div>
	</div>
</a>
