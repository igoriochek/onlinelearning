<x-modal name="moderate-review">
  <div class="p-6" x-data="{ review: null }"
    x-init="$watch('selectedReview', value => review = value)">

    <h3 class="text-lg font-semibold mb-4 text-gray-900">
      Moderate Review
    </h3>

    <div>
      <div class="mb-4 text-gray-600" x-show="review">
        <p><strong>User:</strong> <span x-text="review?.user?.name"></span></p>
        <p><strong>Course:</strong> <span x-text="review?.course?.title"></span></p>
        <p><strong>Rating:</strong> <span x-text="review?.rating"></span></p>
        <div class="mt-2 border rounded-lg p-4 bg-gray-50 text-gray-800">
          <span x-text="review?.comment"></span>
        </div>
      </div>

      <div class="flex justify-between gap-3">
        <x-secondary-button type="button" @click="$dispatch('close-modal', 'moderate-review')">
          Cancel
        </x-secondary-button>
        <div>
          <form method="POST" :action="`/admin/reviews/${review?.id}`" class="flex gap-2">
            @csrf
            @method('PATCH')

            <x-danger-button type="submit" name="status" value="rejected">
              Reject
            </x-danger-button>

            <x-primary-button type="submit" name="status" value="approved">
              Approve
            </x-primary-button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-modal>