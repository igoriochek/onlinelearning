<x-modal name="delete-user">
  <form
    x-bind:action="`{{ route('admin.users.destroy', ':id') }}`.replace(':id', userId)"
    method="POST"
    class="p-6">

    @csrf
    @method('DELETE')

    <h3 class="text-lg font-semibold mb-4 text-gray-900">Delete User</h3>
    <p class="text-gray-600 mb-6">
      Are you sure you want to delete this user? This action cannot be undone.
    </p>

    <div class="flex justify-end gap-2">
      <x-secondary-button
        type="button"
        @click="$dispatch('close-modal', 'delete-user')">
        Cancel
      </x-secondary-button>
      <x-danger-button type="submit">Delete</x-danger-button>
    </div>
  </form>
</x-modal>