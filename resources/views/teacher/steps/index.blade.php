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
				href="{{ route('teacher.sections.lessons.index', $lesson->section->id) }}"
				class="text-blue-500"
			>
				Lessons
			</a>
			/ Steps
		</nav>
	</x-slot>

	<main class="max-w-7xl mx-auto py-6">
		<div class="bg-white p-6 rounded-lg shadow">
			<div class="flex justify-between items-center mb-6">
				<h3 class="text-lg font-semibold text-gray-900">Lesson Steps</h3>
				<x-primary-button
					href="{{ route('teacher.lessons.steps.create', $lesson->id) }}"
				>
					Add Step
				</x-primary-button>
			</div>
			@if ($lesson->steps->isEmpty())
				<p class="text-gray-500">No steps created yet.</p>
			@else
				<div class="space-y-4">
					@foreach ($lesson->steps->sortBy('position') as $step)
						<div
							class="p-4 border rounded-lg flex items-center justify-between
								mb-4"
						>
							<div class="flex items-center gap-3">
								<x-steps.step-type :type="$step->type" />
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</main>
</x-app-layout>
