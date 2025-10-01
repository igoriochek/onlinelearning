<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ __('Create a course') }}
		</h2>
	</x-slot>
	<main
		class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 py-6 px-2"
	>
		<form
			action="{{ route('teacher.courses.store') }}"
			method="POST"
			enctype="multipart/form-data"
			class="md:col-span-4 bg-white p-6 rounded shadow"
		>
			@csrf

			<div class="mb-4">
				<label for="title" class="block font-medium text-gray-700">
					Course Title
				</label>
				<input
					type="text"
					name="title"
					id="title"
					class="mt-1 block w-full border-gray-300 rounded-md"
					required
				/>
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
				></textarea>
			</div>

			<div class="mb-4">
				<label for="level" class="block font-medium text-gray-700">Level</label>
				<select
					name="level"
					id="level"
					class="mt-1 block w-full border-gray-300 rounded-md"
				>
					<option value="beginner">Beginner</option>
					<option value="intermediate">Intermediate</option>
					<option value="advanced">Advanced</option>
				</select>
			</div>

			<div class="mb-4">
				<label for="price" class="block font-medium text-gray-700">Price</label>
				<input
					type="number"
					name="price"
					id="price"
					class="mt-1 block w-full border-gray-300 rounded-md"
					min="0"
					step="0.01"
				/>
			</div>

			<div class="mb-4">
				<label for="image" class="block font-medium text-gray-700">
					Course Image
				</label>
				<input type="file" name="image" id="image" class="mt-1 block w-full" />
			</div>

			<button
				type="submit"
				class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
			>
				Create Course
			</button>
		</form>
	</main>
</x-app-layout>
