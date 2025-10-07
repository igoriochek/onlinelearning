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
					<label for="title" class="block font-medium text-gray-700">
						Course Title
					</label>
					<input
						type="text"
						name="title"
						id="title"
						value="{{ old('title') }}"
						class="mt-1 block w-full border-gray-300 rounded-md"
						required
					/>
					@error('title')
						<span class="text-red-500 text-sm mt-1">{{ $message }}</span>
					@enderror
				</div>

				<div class="mb-2">
					<label for="level" class="block font-medium text-gray-700">
						Level
					</label>
					<select
						name="level"
						id="level"
						class="mt-1 block w-full border-gray-300 rounded-md"
					>
						<option value="1">Beginner</option>
						<option value="2">Intermediate</option>
						<option value="3">Advanced</option>
					</select>
				</div>
				<div class="mb-2 flex items-end gap-4">
					<div id="price_wrapper">
						<label for="price" class="block font-medium text-gray-700">
							Price $
						</label>
						<input
							type="number"
							name="price"
							id="price"
							class="mt-1 border-gray-300 rounded-md"
							min="0"
							step="0.1"
							value="{{ old('price') }}"
							required
						/>
						@error('price')
							<span class="text-red-500 text-sm mt-1">{{ $message }}</span>
						@enderror
					</div>
					<div class="flex items-center gap-2 md:pb-2">
						<input
							type="checkbox"
							name="free_course"
							id="free_course"
							value="1"
							onchange="togglePrice(this)"
							class="h-5 w-5 rounded"
						/>
						<label for="free_course" class="text-gray-700">Free course</label>
						<input
							type="checkbox"
							name="public"
							id="public"
							value="1"
							class="h-5 w-5 rounded"
							{{ old('public') ? 'checked' : '' }}
						/>
						<label for="public" class="text-gray-700">Public course</label>
					</div>
				</div>
				<div class="mb-2 pt-1">
					<label for="image" class="block font-medium text-gray-700">
						Course Image
					</label>
					<input
						type="file"
						name="image"
						id="image"
						class="mt-1 block w-full rounded border"
					/>
				</div>
			</div>

			<div class="mb-4">
				<label for="description" class="block font-medium text-gray-700">
					Description
				</label>
				<textarea
					name="description"
					id="description"
					rows="4"
					class="mt-1 block w-full border-gray-300 rounded-md"
				>
{{ old('description') }}</textarea
				>
				@error('description')
					<span class="text-red-500 pt-2">{{ $message }}</span>
				@enderror
			</div>

			<div id="sections_wrapper">
				@include('teacher.courses.partials.section', ['index' => 0])
			</div>

			<button
				type="button"
				onclick="addSection()"
				class="mt-2 bg-green-600 text-white px-3 py-1 rounded
					hover:bg-green-700"
			>
				+ Add Section
			</button>

			<button
				type="submit"
				class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
			>
				Create Course
			</button>
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
	});
</script>
<script>
	let sectionIndex = 1;

	function addSection() {
		const wrapper = document.getElementById('sections_wrapper');
		let html = `{!! str_replace('__INDEX__', '__INDEX__', view('teacher.courses.partials.section', ['index' => '__INDEX__'])->render()) !!}`;

		html = html.replace(/__INDEX__/g, sectionIndex);

		const temp = document.createElement('div');
		temp.innerHTML = html;
		wrapper.appendChild(temp.firstElementChild);

		sectionIndex++;
	}
</script>
