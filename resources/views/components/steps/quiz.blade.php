@props([
  'step',
  'type' => 'single',
  //'single'arba'multiple',
])

<form action="{{ route('lessons.step.submit', $step) }}" method="POST">
	@csrf
	<fieldset class="space-y-4">
		<legend class="text-lg font-semibold">{{ $step->question }}</legend>

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
			disabled
		>
			Submit Answer
		</button>
	</div>
</form>

<script>
	const inputs = document.querySelectorAll(
		"input[name='{{ $type === 'single' ? 'answer' : 'answer[]' }}']",
	);
	const submitBtn = document.getElementById('submit-btn');
	inputs.forEach((input) => {
		input.addEventListener('change', () => {
			submitBtn.disabled = ![...inputs].some((i) => i.checked);
		});
	});
</script>
