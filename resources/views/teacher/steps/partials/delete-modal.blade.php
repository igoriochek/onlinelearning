<x-modal name="delete-step">
  <form
    x-bind:action="`{{ route('teacher.steps.destroy', ':id') }}`.replace(':id', stepId)"
    method="POST"
    class="p-6">
    @csrf
    @method('DELETE')

    <h3 class="text-lg font-semibold mb-4 text-gray-900">{{ __('modals.delete_step') }}</h3>
    <p class="text-gray-600 mb-6">
      {{ __('modals.delete_step_confirm') }}
    </p>

    <div class="flex justify-end gap-2">
      <x-secondary-button
        type="button"
        @click="$dispatch('close-modal', 'delete-step')">
        {{ __('modals.cancel') }}
      </x-secondary-button>
      <x-danger-button type="submit">{{ __('modals.delete') }}</x-danger-button>
    </div>
  </form>
</x-modal>