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
		class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
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
				<div
					x-data="reorderItems('{{ route('teacher.sections.lessons.reorder', $section->id) }}')"
					class="space-y-4"
				>
					@foreach ($section->lessons as $lesson)
						<div
							class="p-4 border rounded-lg space-y-4"
							data-id="{{ $lesson->id }}"
						>
							<div
								class="flex flex-col sm:flex-row sm:items-center
									sm:justify-between gap-4"
							>
								<div class="flex items-center gap-3">
									<div
										class="cursor-grab text-gray-400 hover:text-gray-600 pt-1"
									>
										<x-icons.drag-handle />
									</div>
									<div>
										<span class="text-sm text-gray-500">
											#{{ $lesson->position }}
										</span>
										<p
											id="lesson-title-{{ $lesson->id }}"
											class="text-base font-medium text-gray-900"
										>
											{{ $lesson->title }}
										</p>
									</div>
								</div>

								<div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
									<x-secondary-button
										href="{{ route('teacher.lessons.steps.index', $lesson->id) }}"
										class="w-full sm:w-auto justify-center"
									>
										Manage Steps
									</x-secondary-button>

									<x-primary-button
										@click="
                      lessonId = '{{ $lesson->id }}';
                      lessonTitle = document.querySelector('#lesson-title-{{ $lesson->id }}').textContent;
                      $dispatch('open-modal','edit-lesson');"
										class="w-full sm:w-auto justify-center"
									>
										Edit
									</x-primary-button>

									<x-danger-button
										@click="
                      lessonId = '{{ $lesson->id }}';
                      $dispatch('open-modal','delete-lesson');"
										class="w-full sm:w-auto justify-center"
									>
										Delete
									</x-danger-button>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>

		@include('teacher.lessons.partials.create-modal')
		@include('teacher.lessons.partials.delete-modal')
		@include('teacher.lessons.partials.edit-modal')
	</main>
</x-app-layout>
