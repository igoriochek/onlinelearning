<x-modal name="create-section">
  <form
    action="{{ route('teacher.courses.sections.store', $course->id) }}"
    method="POST"
    class="p-6">
    @csrf
    <h3 class="text-lg font-semibold mb-4">{{ __('modals.add_section') }}</h3>
    <x-text-input
      type="text"
      placeholder="{{ __('modals.section_title') }}"
      name="title"
      id="title"
      required
      class="w-full mb-4" />
    <div class="flex justify-end gap-2">
      <x-secondary-button
        type="button"
        @click="$dispatch('close-modal', 'create-section')">
        {{ __('modals.cancel') }}
      </x-secondary-button>
      <x-primary-button type="submit">{{ __('modals.save') }}</x-primary-button>
    </div>
  </form>
</x-modal>