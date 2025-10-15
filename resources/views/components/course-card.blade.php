@props([
  'course',
  'builder' => false,
])

<a
	href="{{ $builder ? route('teacher.courses.show', $course->id) : route('courses.show', $course->id) }}"
	class="block"
>
	<div
		class="bg-white shadow-sm rounded-lg overflow-hidden hover:shadow-md
			transition-shadow"
	>
		<img
			src="{{ $course->image_url ? asset('storage/' . $course->image_url) : 'https://placehold.co/600x400?text=Course+Image' }}"
			alt="{{ $course->title }}"
			class="w-full h-40 object-cover"
		/>
		<div class="p-4">
			<h3 class="text-lg font-bold">{{ $course->title }}</h3>
			<p class="text-sm text-gray-600 line-clamp-2">
				{{ $course->description }}
			</p>

			@if (! $builder && $course->averageRating)
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
				<span class="font-semibold text-green-600">
					@if ($course->price == 0)
						Free
					@else
						${{ $course->price }}
					@endif
				</span>
			</div>

			@auth
				@if (! $builder)
					<x-wishlist-button :course="$course" variant="text" />
				@endif
			@endauth
		</div>
	</div>
</a>
