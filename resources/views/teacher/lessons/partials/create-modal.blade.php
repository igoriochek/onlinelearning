<x-modal name="create-lesson">
  <form
    action="{{ route('teacher.sections.lessons.store', $section->id) }}"
    method="POST"
    class="p-6">
    @csrf
    <h3 class="text-lg font-semibold mb-4">{{ __('modals.add_lesson') }}</h3>
    <x-text-input
      type="text"
      placeholder="{{ __('modals.lesson_title') }}"
      name="title"
      id="lesson-title"
      required
      class="w-full mb-4" />
    <div class="flex justify-end gap-2">
      <x-secondary-button
        type="button"
        @click="$dispatch('close-modal', 'create-lesson')">
        {{ __('modals.cancel') }}
      </x-secondary-button>

      <x-primary-button type="submit">{{ __('modals.save') }}</x-primary-button>
    </div>
  </form>
</x-modal>