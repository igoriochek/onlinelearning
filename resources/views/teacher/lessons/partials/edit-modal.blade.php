<x-modal name="edit-lesson">
	<form
		@submit.prevent="
            fetch(`/teach/lessons/${lessonId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ title: lessonTitle })
            })
            .then(res => res.json())
            .then(data => {
                document.querySelector(`#lesson-title-${data.id}`).textContent = data.title;
                $dispatch('close-modal', 'edit-lesson');
            })
            .catch(err => console.error(err))
        "
		class="p-6"
	>
		@csrf
		@method('PUT')
		<h3 class="text-lg font-semibold mb-4">Edit Lesson</h3>
		<x-text-input
			type="text"
			placeholder="Lesson Title"
			name="title"
			x-model="lessonTitle"
			required
			class="w-full mb-4"
		/>
		<div class="flex justify-end gap-2">
			<x-secondary-button
				type="button"
				@click="$dispatch('close-modal', 'edit-lesson')"
			>
				Cancel
			</x-secondary-button>
			<x-primary-button type="submit">Save Changes</x-primary-button>
		</div>
	</form>
</x-modal>
