@props([
'courseId',
'userRating' => null,
'userComment' =>null,
])

<form method="POST" action="{{  route('courses.review.store', $courseId) }}" class="border p-4 rounded-lg bg-white shadow-md space-y-4 text-center">
  @csrf
  <h2 class="text-xl font-semibold text-gray-800">Share your experience</h2>

  <div>
    <p class="font-medium text-gray-700 mb-2">How would you rate this course?</p>
    <div class="flex justify-center gap-2" x-data="{ rating: @json($userRating ?? 0), hover: 0 }">
      @for ($i = 1; $i <= 5; $i++)
        <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6 cursor-pointer transition-colors duration-200"
        :class="hover >= {{ $i }} || (!hover && rating >= {{ $i }}) ? 'text-yellow-400' : 'text-gray-300'"
        @mouseenter="hover = {{ $i }}"
        @mouseleave="hover = 0"
        @click="rating = {{ $i }}; $refs.ratingInput.value = {{ $i }}">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
        </svg>
        @endfor
        <input type="hidden" name="rating" x-ref="ratingInput" :value="rating" />
    </div>
  </div>

  <div class="flex flex-col items-center">
    <label for="comment" class="font-medium text-gray-700 mb-1">Review</label>
    <x-text-area-input
      id="comment"
      name="comment"
      rows="4"
      required
      class="w-full"
      placeholder="Write your review...">{{ old('comment', $userComment) }}</x-text-area-input>
    <x-input-error :messages="$errors->get('comment')" class="mt-1" />
  </div>

  <x-primary-button type="submit" class="mt-4 px-6 py-2 ">
    Submit
  </x-primary-button>
</form>