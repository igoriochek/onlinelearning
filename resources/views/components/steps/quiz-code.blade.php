@props([
  'step',
])

<form
	action="{{ route('lessons.step.submit', $step) }}"
	method="POST"
	x-data="{
 	code: '',
 	get canSubmit() {
 		return this.code.trim().length > 0
 	},
 }"
>
	@csrf
	<fieldset class="space-y-4">
		<p class="text-sm">
			{!! $step->content !!}
		</p>
		<p class="text-lg font-semibold mt-2">{{ $step->question }}</p>

		<textarea
			name="answer"
			x-model="code"
			rows="10"
			class="w-full p-2 border rounded font-mono text-sm bg-gray-100"
			placeholder="// Write your code here..."
		></textarea>
	</fieldset>

	<div class="flex justify-center">
		<button
			type="submit"
			class="mt-4 px-4 py-2 bg-blue-600 text-white rounded disabled:bg-gray-400
				disabled:cursor-not-allowed"
			:disabled="!canSubmit"
		>
			Submit Answer
		</button>
	</div>
</form>
