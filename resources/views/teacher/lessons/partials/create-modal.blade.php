<x-modal name="add-lesson">
	<form
		action="{{ route('teacher.sections.lessons.store', $section->id) }}"
		method="POST"
		class="p-6"
	>
		@csrf
		<h3 class="text-lg font-semibold mb-4">Add New Lesson</h3>
		<x-text-input
			type="text"
			placeholder="Lesson Title"
			name="title"
			id="lesson-title"
			required
			class="w-full mb-4"
		/>
		<div class="flex justify-end gap-2">
			<x-secondary-button
				type="button"
				@click="$dispatch('close-modal', 'add-lesson')"
			>
				Cancel
			</x-secondary-button>

			<x-primary-button type="submit">Save</x-primary-button>
		</div>
	</form>
</x-modal>
