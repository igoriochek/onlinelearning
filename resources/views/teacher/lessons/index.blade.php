<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $section->title }} — Lessons
		</h2>
		<nav class="text-sm text-gray-500 mt-1">
			<a
				href="{{ route('teacher.courses.show', $section->course_id) }}"
				class="text-blue-500"
			>
				Course Overview
			</a>
			/
			<a
				href="{{ route('teacher.courses.sections.index', $section->course_id) }}"
				class="text-blue-500"
			>
				Sections
			</a>
			/ Lessons
		</nav>
	</x-slot>

	<main
		x-data="{ lessonId: null, lessonTitle: '' }"
		class="max-w-7xl mx-auto py-6"
	>
		<div class="bg-white p-6 rounded-lg shadow">
			<div class="flex justify-between items-center mb-6">
				<h3 class="text-lg font-semibold text-gray-900">Lessons</h3>

				<x-primary-button @click="$dispatch('open-modal', 'create-lesson')">
					Add Lesson
				</x-primary-button>
			</div>
			@if ($section->lessons->isEmpty())
				<p class="text-gray-500">No lessons created yet.</p>
			@else
				@foreach ($section->lessons as $lesson)
					<div
						class="p-4 border rounded-lg flex justify-between items-center mb-4"
					>
						<p id="lesson-title-{{ $lesson->id }}">{{ $lesson->title }}</p>
						<div class="flex gap-2">
							<x-secondary-button
								href="{{ route('teacher.steps.index', $lesson->id) }}"
							>
								Manage Lesson Steps
							</x-secondary-button>
							<x-primary-button
								@click="
                  lessonId = '{{ $lesson->id }}';
                  lessonTitle = document.querySelector('#lesson-title-{{ $lesson->id }}').textContent;
                  $dispatch('open-modal','edit-lesson');"
							>
								Edit
							</x-primary-button>
							<x-danger-button
								@click="
                  lessonId = '{{ $lesson->id }}';
                  $dispatch('open-modal','delete-lesson');"
							>
								Delete
							</x-danger-button>
						</div>
					</div>
				@endforeach
			@endif
		</div>
		@include('teacher.lessons.partials.create-modal')
		@include('teacher.lessons.partials.delete-modal')
		@include('teacher.lessons.partials.edit-modal')
	</main>
</x-app-layout>
