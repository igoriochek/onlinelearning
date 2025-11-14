<div x-data="quizForm()" x-init="init" class="space-y-4">
	<div>
		<x-input-label value="Step Content" />
		<x-text-area-input
			name="content_quiz"
			id="content_quiz"
			rows="5"
			class="editor mb-4"
			x-bind:disabled="!stepType.startsWith('quiz')"
		>
			{{ old('content_quiz', $content ?? '') }}
		</x-text-area-input>
		<x-input-error :messages="$errors->get('content_quiz')" class="mt-1" />
	</div>

	<div>
		<x-input-label value="Question" />
		<x-text-input
			type="text"
			name="question"
			class="w-full"
			value="{{ old('question', $question ?? '') }}"
			x-bind:disabled="!stepType.startsWith('quiz')"
			required
		/>
		<x-input-error :messages="$errors->get('question')" class="mt-1" />
	</div>

	<div>
		<x-input-label value="Input Type" />
		<x-select-input
			name="quiz_type"
			id="quiz_type"
			x-model="quizType"
			x-bind:disabled="!stepType.startsWith('quiz')"
		>
			<option value="quiz_single">Radio Buttons</option>
			<option value="quiz_multiple">Checkboxes</option>
		</x-select-input>
	</div>

	<div class="space-y-2">
		<x-input-label value="Options" />
		@if ($errors->has('options_correct'))
			<div class="text-red-500 text-sm mt-1">
				{{ $errors->first('options_correct') }}
			</div>
		@endif

		<template x-for="(option, index) in options" :key="index">
			<div
				class="flex items-center gap-3 p-3 border rounded-lg bg-white shadow-sm"
			>
				<div class="cursor-grab text-gray-400 hover:text-gray-600">
					<x-icons.drag-handle />
				</div>
				<input
					type="hidden"
					:name="'options[' + index + '][id]'"
					:value="option.id"
					x-bind:disabled="! stepType.startsWith('quiz')"
				/>
				<template x-if="quizType === 'quiz_multiple'">
					<input
						type="checkbox"
						:name="'options['+index+'][correct]'"
						x-model="option.correct"
						class="w-5 h-5 text-blue-600 focus:ring-blue-500"
						x-bind:disabled="! stepType.startsWith('quiz')"
					/>
				</template>

				<template x-if="quizType === 'quiz_single'">
					<input
						type="radio"
						:name="'options[' + index + '][correct]'"
						:checked="option.correct"
						@change="options.forEach((o, i) => o.correct = (i === index))"
						class="w-5 h-5"
					/>
				</template>

				<x-text-input
					type="text"
					x-bind:name="'options[' + index + '][text]'"
					x-model="option.text"
					class="flex-1 px-3 py-2"
					placeholder="Enter option text..."
					x-bind:disabled="!stepType.startsWith('quiz')"
					required
				/>

				<button
					type="button"
					x-show="options.length > 2"
					@click="removeOption(index)"
					class="text-red-500 hover:text-red-700 transition"
					title="Delete option"
				>
					<x-icons.remove />
				</button>
			</div>
		</template>
		@if ($errors->has('options.*.text'))
			<div class="text-red-500 text-sm mt-1">
				All option texts are required.
			</div>
		@endif

		<button
			type="button"
			@click="addOption()"
			class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600
				transition"
		>
			Add Option
		</button>
	</div>
</div>

<script>
	function quizForm() {
		return {
			// prettier-ignore
			quizType: "{{ old('quiz_type', $quizType ?? 'quiz_single') }}",
			options: JSON.parse(
				`{!!
      json_encode(
      	old(
      		'options',
      		isset($options)
      			? $options
      				->map(
      					fn ($o) => [
      						'id' => $o->id,
      						'text' => $o->text,
      						'correct' => (bool) $o->is_correct,
      					],
      				)
      				->values()
      			: [
      				['text' => '', 'correct' => false],
      				['text' => '', 'correct' => false],
      			],
      	),
      )
    !!}`,
			).map((opt) => ({
				id: opt.id ?? null,
				text: opt.text || '',
				correct: !!opt.correct,
			})),
			addOption() {
				this.options.push({ text: '', correct: false });
			},
			removeOption(index) {
				this.options.splice(index, 1);
			},
			init() {
				this.$watch('quizType', (newType) => {
					if (newType === 'quiz_single') {
						let selected = false;
						this.options = this.options.map((opt) => {
							if (!selected && opt.correct) {
								selected = true;
								return { ...opt, correct: true };
							}
							return { ...opt, correct: false };
						});
						if (!selected && this.options.length > 0) {
							this.options[0].correct = true;
						}
					}
				});
			},
		};
	}
</script>
