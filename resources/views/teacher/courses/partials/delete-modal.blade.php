<x-modal name="delete-course">
	<form
		x-bind:action="`{{ route('teacher.courses.destroy', ':id') }}`.replace(':id', courseId)"
		method="POST"
		class="p-6"
	>
		@csrf
		@method('DELETE')

		<h3 class="text-lg font-semibold mb-4 text-gray-900">Delete Course</h3>
		<p class="text-gray-600 mb-6">
			Are you sure you want to delete the course
			<span class="font-semibold text-gray-900" x-text="courseTitle"></span>
			?
			<br />
			This action cannot be undone.
		</p>

		<div class="flex justify-end gap-2">
			<x-secondary-button
				type="button"
				@click="$dispatch('close-modal', 'delete-course')"
			>
				Cancel
			</x-secondary-button>

			<x-danger-button type="submit">Delete</x-danger-button>
		</div>
	</form>
</x-modal>
