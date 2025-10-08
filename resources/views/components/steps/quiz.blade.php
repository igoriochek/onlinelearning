@props([
  'step',
  'type' => 'single',
])

<form
	action="{{ route('lessons.step.submit', $step) }}"
	method="POST"
	x-data="{ canSubmit: false }"
	@change="canSubmit = [...$el.querySelectorAll('input')].some(i => i.checked)"
>
	@csrf
	<fieldset class="space-y-4">
		<p class="text-sm">
			{!! $step->content !!}
		</p>
		<p class="text-lg font-semibold mt-2">{{ $step->question }}</p>

		@foreach ($step->options as $option)
			<label class="flex items-center gap-2">
				<input
					type="{{ $type === 'single' ? 'radio' : 'checkbox' }}"
					name="{{ $type === 'single' ? 'answer' : 'answer[]' }}"
					value="{{ $option->id }}"
				/>
				<span>{{ $option->text }}</span>
			</label>
		@endforeach
	</fieldset>

	<div class="flex justify-center">
		<x-primary-button
			type="submit"
			x-bind:disabled="!canSubmit"
			class="mt-4 justify-center"
		>
			Submit Answer
		</x-primary-button>
	</div>
</form>
