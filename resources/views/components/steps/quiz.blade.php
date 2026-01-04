@props([
'step',
'type' => 'single',
'isAuthor' => false,
])

<form
  action="{{ route('lessons.step.submit', $step) }}"
  method="POST"
  x-data="{ canSubmit: false }"
  @change="canSubmit = [...$el.querySelectorAll('input')].some(i => i.checked)">
  @csrf
  <fieldset class="space-y-4">
    <div class="prose max-w-none">
      {!! $step->content !!}
    </div>
    <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
      <p class="font-semibold text-gray-800">{{ $step->question }}</p>

      @foreach ($step->options as $option)
      <label class="flex items-center gap-2 py-2">
        <input
          @if($isAuthor) disabled @endif
          type="{{ $type === 'single' ? 'radio' : 'checkbox' }}"
          name="{{ $type === 'single' ? 'answer' : 'answer[]' }}"
          value="{{ $option->id }}" />
        <span class="block px-3 py-1 rounded-m text-gray-800">
          {{ $option->text }}
        </span>
      </label>
      @endforeach
    </div>
  </fieldset>

  @unless($isAuthor)
  <div class="flex justify-center">
    <x-primary-button
      type="submit"
      x-bind:disabled="!canSubmit"
      class="mt-4 justify-center">
      Submit Answer
    </x-primary-button>
  </div>
  @endunless
</form>