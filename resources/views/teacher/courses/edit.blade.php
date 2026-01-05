<x-app-layout>
  @section('title', __('teacher.edit_course'))
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('teacher.edit_course') }} {{ $course->title }}
    </h2>
    <div class="text-sm mt-1">
      <a href="{{ route('teacher.courses.show', $course) }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        {{__('nav.back')}}
      </a>
    </div>
  </x-slot>

  <main
    class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-4 py-6 px-2">
    <form
      action="{{ route('teacher.courses.update', $course) }}"
      method="POST"
      enctype="multipart/form-data"
      class="md:col-span-4 bg-white p-6 rounded-lg shadow">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="mb-2">
          <x-input-label for="title" :value="__('teacher.course_title')" />
          <x-text-input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $course->title) }}"
            required
            class="mt-1 block w-full" />
          <x-input-error :messages="$errors->get('title')" class="mt-1" />
        </div>

        <div class="mb-2">
          <x-input-label for="level" :value="__('teacher.level')" />
          <x-select-input name="level" id="level">
            <option value="1" @selected($course->level == 1)>{{ __('teacher.level_beginner') }}</option>
            <option value="2" @selected($course->level == 2)>
              {{ __('teacher.level_intermediate') }}
            </option>
            <option value="3" @selected($course->level == 3)>{{ __('teacher.level_advanced') }}</option>
          </x-select-input>
        </div>

        <div class="mb-4 flex items-end gap-4">
          <div id="price_wrapper">
            <x-input-label for="price" :value="__('teacher.price')" />
            <x-text-input
              type="number"
              name="price"
              id="price"
              value="{{ old('price', $course->price) }}"
              min="0"
              step="0.1"
              required
              class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('price')" />
          </div>

          <div class="flex items-center gap-2 md:pb-2">
            <x-checkbox-input
              name="free_course"
              id="free_course"
              :checked="old('free_course', $course->price == 0)" />
            <x-input-label for="free_course">{{ __('teacher.free_course') }}</x-input-label>
          </div>
        </div>

        <div class="mb-2 pt-1">
          <x-input-label for="image" :value="__('teacher.course_image')" />

          <div class="mb-2">
            <img
              id="image-preview"
              src="{{ $course->image_url ? asset('storage/' . $course->image_url) : 'https://placehold.co/128x128?text=Preview' }}"
              alt="{{ __('teacher.preview') }}"
              class="w-32 h-32 object-cover rounded" />
          </div>

          <input
            type="file"
            name="image"
            id="image"
            class="mt-1 block w-full rounded border" />
        </div>
      </div>

      <div class="mb-4">
        <x-input-label for="description" :value="__('teacher.description')" />
        <x-text-area-input name="description" id="description" rows="4">
          {{ old('description', $course->description) }}
        </x-text-area-input>
        <x-input-error :messages="$errors->get('description')" class="mt-1" />
      </div>

      <div class="flex justify-between mt-4">
        <x-secondary-button href="{{ route('teacher.courses.show', $course) }}">{{ __('teacher.cancel') }}</x-secondary-button>
        <x-primary-button type="submit">{{ __('teacher.update') }}</x-primary-button>
      </div>
    </form>
  </main>
</x-app-layout>

<script>
  function togglePrice(checkbox) {
    const priceWrapper = document.getElementById('price_wrapper');
    const priceInput = document.getElementById('price');
    if (checkbox.checked) {
      priceInput.value = 0;
      priceInput.disabled = true;
      priceWrapper.classList.add('opacity-50');
    } else {
      priceInput.disabled = false;
      priceWrapper.classList.remove('opacity-50');
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('free_course');
    togglePrice(checkbox);
    checkbox.addEventListener('change', () => togglePrice(checkbox));

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        imagePreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });
  });
</script>