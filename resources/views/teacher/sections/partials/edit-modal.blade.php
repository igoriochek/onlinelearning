<x-modal name="edit-section">
	<form
		@submit.prevent="
            fetch(`/teach/sections/${sectionId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ title: sectionTitle })
            })
            .then(res => res.json())
            .then(data => {
                document.querySelector(`#section-title-${data.id}`).textContent = data.title;
                $dispatch('close-modal', 'edit-section');
            })
            .catch(err => console.error(err))
        "
		class="p-6"
	>
		@csrf
		@method('PUT')
		<h3 class="text-lg font-semibold mb-4">Edit Section</h3>
		<x-text-input
			type="text"
			placeholder="Section Title"
			name="title"
			x-model="sectionTitle"
			required
			class="w-full mb-4"
		/>
		<div class="flex justify-end gap-2">
			<x-secondary-button
				type="button"
				@click="$dispatch('close-modal', 'edit-section')"
			>
				Cancel
			</x-secondary-button>
			<x-primary-button type="submit">Save Changes</x-primary-button>
		</div>
	</form>
</x-modal>
