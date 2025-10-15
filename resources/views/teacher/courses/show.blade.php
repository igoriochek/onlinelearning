<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $course->title }} — Overview
		</h2>
	</x-slot>

	<main class="max-w-7xl mx-auto py-6">
		<div class="bg-white p-6 rounded-lg shadow">
			<h3 class="text-lg font-semibold mb-2">Course Overview</h3>
			<img
				src="{{ $course->image_url ? asset('storage/' . $course->image_url) : 'https://placehold.co/600x400?text=Course+Image' }}"
				alt="{{ $course->title }}"
				class="rounded-lg mb-4"
				loading="lazy"
			/>
			<p class="text-gray-700 mb-4">{{ $course->description }}</p>

			<div class="flex items-center justify-between border-t pt-4">
				<div class="flex flex-col sm:flex-row items-center gap-4">
					<x-input-label
						for="course-visibility"
						value="Make course public:"
						class="mb-1"
					/>
					<x-switch
						id="course-visibility"
						:checked="$course->public"
						:action="route('teacher.courses.publish', $course->id)"
					/>
				</div>

				<div class="flex flex-col sm:flex-row gap-3">
					<x-secondary-button>Edit course info</x-secondary-button>
					<x-primary-button
						:href="route('teacher.sections.index', $course->id)"
					>
						Manage Sections
					</x-primary-button>
				</div>
			</div>
		</div>
	</main>
</x-app-layout>
