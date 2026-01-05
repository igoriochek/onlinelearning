<x-modal name="delete-lesson">
  <form
    x-bind:action="`{{ route('teacher.lessons.destroy', ':id') }}`.replace(':id', lessonId)"
    method="POST"
    class="p-6">
    @csrf
    @method('DELETE')

    <h3 class="text-lg font-semibold mb-4 text-gray-900">{{ __('modals.delete_lesson') }}</h3>
    <p class="text-gray-600 mb-6">
      {{ __('modals.delete_lesson_confirm') }}
    </p>

    <div class="flex justify-end gap-2">
      <x-secondary-button
        type="button"
        @click="$dispatch('close-modal', 'delete-lesson')">
        {{ __('modals.cancel') }}
      </x-secondary-button>
      <x-danger-button type="submit">{{ __('modals.delete') }}</x-danger-button>
    </div>
  </form>
</x-modal>