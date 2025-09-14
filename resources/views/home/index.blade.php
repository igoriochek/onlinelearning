<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ __('Available Courses') }}
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
				@foreach ($courses as $course)
					<x-course-card :course="$course" />
				@endforeach
			</div>
		</div>
	</div>
</x-app-layout>
