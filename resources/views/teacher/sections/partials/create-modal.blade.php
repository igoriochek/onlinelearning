<x-modal name="create-section">
	<form
		action="{{ route('teacher.courses.sections.store', $course->id) }}"
		method="POST"
		class="p-6"
	>
		@csrf
		<h3 class="text-lg font-semibold mb-4">Add New Section</h3>
		<x-text-input
			type="text"
			placeholder="Section Title"
			name="title"
			id="title"
			required
			class="w-full mb-4"
		/>
		<div class="flex justify-end gap-2">
			<x-secondary-button
				type="button"
				@click="$dispatch('close-modal', 'create-section')"
			>
				Cancel
			</x-secondary-button>
			<x-primary-button type="submit">Save</x-primary-button>
		</div>
	</form>
</x-modal>
