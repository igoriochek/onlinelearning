@extends('dashboard.index')

@section('dashboard-content')
	<h3 class="text-lg font-semibold mb-4">My Courses</h3>

	@if ($courses->isEmpty())
		<p class="text-gray-500">You have not created any courses yet.</p>
	@else
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
			@foreach ($courses as $course)
				<div class="bg-white p-4 rounded-lg shadow flex flex-col">
					<img
						src="{{ $course->image_url ? asset('storage/' . $course->image_url) : 'https://placehold.co/400x200?text=Course+Image' }}"
						alt="{{ $course->title }}"
						class="rounded-lg mb-2"
						loading="lazy"
					/>
					<h4 class="font-semibold mb-2">{{ $course->title }}</h4>
					<p class="text-gray-700 mb-4 line-clamp-3">
						{{ $course->description }}
					</p>

					<div class="mt-auto flex gap-2">
						<x-primary-button
							:href="route('teacher.courses.builder', $course->id)"
						>
							Edit / Builder
						</x-primary-button>
					</div>
				</div>
			@endforeach
		</div>
	@endif
@endsection
