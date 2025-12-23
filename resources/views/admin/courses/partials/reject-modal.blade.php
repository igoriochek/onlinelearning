<x-modal name="reject-course">
  <div class="p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-900">
      {{ __('modals.course_rejection') }}
    </h3>

    <form :action="`/admin/courses/${courseId}/reject`" method="POST">
      @csrf
      @method('PATCH')

      <div class="mb-4">
        <x-text-area-input
          id="reason"
          name="reason"
          class="w-full"
          required
          placeholder="{{__('modals.rejection_reason')}}">
        </x-text-area-input>
      </div>

      <div class="flex justify-between">
        <x-secondary-button type="button" @click="$dispatch('close-modal', 'reject-course')">
          {{ __('modals.cancel') }}
        </x-secondary-button>

        <x-danger-button type="submit">
          {{ __('modals.reject') }}
        </x-danger-button>
      </div>
    </form>
  </div>
</x-modal>