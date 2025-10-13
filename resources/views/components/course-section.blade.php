@props([
  'title',
  'courses',
  'builder' => false,
])

<div class="course-section mb-12">
	<h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>

	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
		@foreach ($courses as $course)
			<x-course-card :course="$course" :builder="$builder" />
		@endforeach
	</div>
</div>
