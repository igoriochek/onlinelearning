<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $course->title }} — Sections
		</h2>
		<nav class="text-sm text-gray-500 mt-1">
			<a
				href="{{ route('teacher.courses.show', $course->id) }}"
				class="text-blue-500"
			>
				Course Overview
			</a>
			/ Sections
		</nav>
	</x-slot>

	<main
		x-data="{ sectionId: null, sectionTitle: '' }"
		class="max-w-7xl mx-auto py-6"
	>
		<div class="bg-white p-6 rounded-lg shadow">
			<div class="flex justify-between items-center mb-6">
				<h3 class="text-lg font-semibold text-gray-900">Sections</h3>

				<x-primary-button @click="$dispatch('open-modal', 'create-section')">
					Add Section
				</x-primary-button>
			</div>

			@if ($course->sections->isEmpty())
				<p class="text-gray-500">No sections created yet.</p>
			@else
				<div
					x-data="reorderItems('{{ route('teacher.courses.sections.reorder', $course->id) }}')"
					class="space-y-4"
				>
					@foreach ($course->sections as $section)
						<div
							class="p-4 border rounded-lg flex justify-between items-center
								mb-4"
							data-id="{{ $section->id }}"
						>
							<div class="flex items-center gap-3">
								<div class="cursor-grab text-gray-400 hover:text-gray-600">
									<x-icons.drag-handle />
								</div>
								<span class="font-semibold text-gray-700">
									#{{ $section->position }}
								</span>
								<p id="section-title-{{ $section->id }}">
									{{ $section->title }}
								</p>
							</div>
							<div class="flex gap-2">
								<x-secondary-button
									href="{{ route('teacher.sections.lessons.index', $section->id) }}"
								>
									Manage Lessons
								</x-secondary-button>
								<x-primary-button
									@click="
                  sectionId = {{ $section->id }};
                  sectionTitle = document.querySelector('#section-title-{{ $section->id }}').textContent;
                  $dispatch('open-modal', 'edit-section');
              "
								>
									Edit
								</x-primary-button>

								<x-danger-button
									@click="
                  sectionId = {{ $section->id }};
                  $dispatch('open-modal', 'delete-section');"
								>
									Delete
								</x-danger-button>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>

		@include('teacher.sections.partials.delete-modal')
		@include('teacher.sections.partials.create-modal')
		@include('teacher.sections.partials.edit-modal')
	</main>
</x-app-layout>
