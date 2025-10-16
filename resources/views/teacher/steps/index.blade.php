<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $lesson->title }} — Steps
		</h2>

		<nav class="text-sm text-gray-500 mt-1">
			<a
				href="{{ route('teacher.courses.show', $lesson->section->course_id) }}"
				class="text-blue-500"
			>
				Course Overview
			</a>
			/
			<a
				href="{{ route('teacher.courses.sections.index', $lesson->section->course_id) }}"
				class="text-blue-500"
			>
				Sections
			</a>
			/
			<a
				href="{{ route('teacher.sections.lessons.index', $lesson->section_id) }}"
				class="text-blue-500"
			>
				Lessons
			</a>
			/ Steps
		</nav>
	</x-slot>

	<main class="max-w-7xl mx-auto py-6">
		<div class="bg-white p-6 rounded-lg shadow">
			<h3 class="text-lg font-semibold text-gray-900 mb-4">Steps</h3>

			@if ($lesson->steps->isEmpty())
				<p class="text-gray-500">No steps created yet.</p>
			@else
				@foreach ($lesson->steps as $step)
					<div
						class="p-4 border rounded-lg flex justify-between items-center mb-4"
					>
						<p>{{ $step->question }}</p>
						<p>
							Type:
							<span class="capitalize">{{ $step->type }}</span>
						</p>
					</div>
				@endforeach
			@endif
		</div>
	</main>
</x-app-layout>
