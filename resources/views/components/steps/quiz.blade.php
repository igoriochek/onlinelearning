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
		<button
			type="submit"
			id="submit-btn"
			class="mt-4 px-4 py-2 bg-blue-600 text-white rounded disabled:bg-gray-400
				disabled:cursor-not-allowed"
			:disabled="!canSubmit"
		>
			Submit Answer
		</button>
	</div>
</form>
