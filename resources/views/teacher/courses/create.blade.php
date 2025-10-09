<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ __('Create a course') }}
		</h2>
	</x-slot>
	<main
		class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-4 py-6 px-2"
	>
		<form
			action="{{ route('teacher.courses.store') }}"
			method="POST"
			enctype="multipart/form-data"
			class="md:col-span-4 bg-white p-6 rounded-lg shadow"
		>
			@csrf

			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div class="mb-2">
					<x-input-label for="title" value="Course Title" />
					<x-text-input
						type="text"
						name="title"
						id="title"
						value="{{ old('title') }}"
						required
						class="mt-1 block w-full"
					/>
					<x-input-error :messages="$errors->get('title')" class="mt-1" />
				</div>

				<div class="mb-2">
					<x-input-label for="level" value="Level" />
					<x-select-input name="level" id="level">
						<option value="1">Beginner</option>
						<option value="2">Intermediate</option>
						<option value="3">Advanced</option>
					</x-select-input>
				</div>

				<div class="mb-4 flex items-end gap-4">
					<div id="price_wrapper">
						<x-input-label for="price" value="Price $" />
						<x-text-input
							type="number"
							name="price"
							id="price"
							value="{{ old('price') }}"
							min="0"
							step="0.1"
							required
							class="mt-1"
						/>
						<x-input-error :messages="$errors->get('price')" />
					</div>
					<div class="flex items-center gap-2 md:pb-2">
						<x-checkbox-input
							name="free_course"
							id="free_course"
							:checked="old('free_course')"
						/>
						<x-input-label for="free_course">Free course</x-input-label>
						<x-checkbox-input
							name="public"
							id="public"
							:checked="old('public')"
						/>
						<x-input-label for="public">Public course</x-input-label>
					</div>
				</div>

				<div class="mb-2 pt-1">
					<x-input-label for="image" value="Course Image" />
					<input
						type="file"
						name="image"
						id="image"
						class="mt-1 block w-full rounded border"
					/>
				</div>
			</div>

			<div class="mb-4">
				<x-input-label for="description" value="Description" />
				<x-text-area-input name="description" id="description" rows="4">
					{{ old('description') }}
				</x-text-area-input>
				<x-input-error :messages="$errors->get('description')" class="mt-1" />
			</div>

			{{-- Sections --}}
			<div id="sections_wrapper">
				@php
     $oldSections = old('sections', [['title' => '']]);
				@endphp

				@foreach ($oldSections as $i => $section)
					<div class="section mb-2 border p-2 rounded-md relative">
						<label
							for="sections_{{ $i }}_title"
							class="flex items-center gap-2 text-sm font-medium text-gray-700"
						>
							<span
								class="section-handle cursor-move text-gray-500
									hover:text-gray-800"
							>
								&#x2630;
							</span>
							Section Title
						</label>
						<x-text-input
							type="text"
							name="sections[{{ $i }}][title]"
							id="sections_{{ $i }}_title"
							value="{{ $section['title'] ?? '' }}"
							required
							class="mt-1 block w-full"
						/>
						<x-input-error
							:messages="$errors->get('sections.' . $i . '.title')"
							class="mt-1"
						/>
						<input type="hidden" class="section-position" />
						<button
							type="button"
							class="remove-section-btn absolute top-2 right-2 text-red-500
								text-lg {{ count($oldSections) > 1 ? '' : 'hidden' }}"
						>
							&times;
						</button>
					</div>
				@endforeach
			</div>

			<template id="section_template">
				<div class="section mb-2 border p-2 rounded-md relative">
					<label class="text-sm font-medium text-gray-700 flex">
						<span class="section-handle cursor-move pr-2">&#x2630;</span>
						Section Title
					</label>
					<input
						type="text"
						required
						class="section-title mt-1 block w-full rounded-md border-gray-300
							focus:border-gray-800 focus:ring-gray-800"
					/>
					<input type="hidden" class="section-position" />
					<button
						type="button"
						class="remove-section-btn absolute top-2 right-2 text-red-500
							text-lg"
					>
						&times;
					</button>
				</div>
			</template>

			<div class="flex justify-end">
				<x-secondary-button
					type="button"
					id="add_section_btn"
					class="rounded !px-2 !py-0 !text-lg"
				>
					+
				</x-secondary-button>
			</div>

			<div class="flex justify-center mt-4">
				<x-primary-button type="submit">Create Course</x-primary-button>
			</div>
		</form>
	</main>
</x-app-layout>
<script>
	function togglePrice(checkbox) {
		const priceWrapper = document.getElementById('price_wrapper');
		const priceInput = document.getElementById('price');
		if (checkbox.checked) {
			priceInput.value = 0;
			priceInput.disabled = true;
			priceWrapper.classList.add('opacity-50');
		} else {
			priceInput.disabled = false;
			priceInput.value = '';
			priceWrapper.classList.remove('opacity-50');
		}
	}

	document.addEventListener('DOMContentLoaded', () => {
		const checkbox = document.getElementById('free_course');
		togglePrice(checkbox);
		checkbox.addEventListener('change', () => {
			togglePrice(checkbox);
		});
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const wrapper = document.getElementById('sections_wrapper');
		const addBtn = document.getElementById('add_section_btn');
		const template = document.getElementById('section_template');

		function updateSections() {
			const sections = wrapper.querySelectorAll('.section');
			sections.forEach((sec, i) => {
				const titleInput = sec.querySelector('input[type="text"]');
				const posInput = sec.querySelector('.section-position');
				const label = sec.querySelector('label');

				if (titleInput) {
					titleInput.name = `sections[${i}][title]`;
					titleInput.id = `section_${i}_title`;
					if (label) label.setAttribute('for', titleInput.id);
				}
				if (posInput) {
					posInput.name = `sections[${i}][position]`;
					posInput.value = i + 1;
				}

				const removeBtn = sec.querySelector('.remove-section-btn');
				if (removeBtn)
					removeBtn.classList.toggle('hidden', sections.length <= 1);
			});
		}

		wrapper.addEventListener('click', (e) => {
			if (e.target.matches('.remove-section-btn')) {
				e.target.closest('.section').remove();
				updateSections();
			}
		});

		addBtn.addEventListener('click', () => {
			const clone = template.content.cloneNode(true);
			wrapper.appendChild(clone);
			updateSections();
		});

		new Sortable(wrapper, {
			handle: '.section-handle',
			animation: 150,
			onEnd: updateSections,
		});

		updateSections();
	});
</script>
