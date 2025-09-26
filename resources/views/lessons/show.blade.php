<x-app-layout>
	@include('lessons.partials.lesson-topbar', ['lesson' => $lesson, 'step' => $step])

	<main
		class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 py-6 px-2"
	>
		@include('lessons.partials.lesson-sidebar', ['course' => $course, 'lesson' => $lesson])

		<section class="md:col-span-3 bg-white shadow rounded-lg p-6">
			@if ($step->type === 'text')
				<div class="prose max-w-none">
					{!! $step->content !!}
				</div>
			@elseif ($step->type === 'video')
				<video controls class="w-full rounded">
					<source src="{{ $step->content }}" type="video/mp4" />
				</video>
			@elseif ($step->type === 'quiz')
				<form action="{{ route('lessons.step.submit', $step) }}" method="POST">
					@csrf
					<fieldset class="space-y-4">
						<legend class="text-lg font-semibold">
							{{ $step->question }}
						</legend>

						@foreach ($step->options as $option)
							<label class="flex items-center gap-2">
								<input type="radio" name="answer" value="{{ $option->id }}" />
								<span>{{ $option->text }}</span>
							</label>
						@endforeach
					</fieldset>

					<div class="flex justify-center">
						<button
							type="submit"
							id="submit-btn"
							class="mt-4 px-4 py-2 bg-blue-600 text-white rounded
								disabled:bg-gray-400 disabled:cursor-not-allowed"
							disabled
						>
							Submit Answer
						</button>
					</div>
				</form>
			@endif
		</section>
		<div class="md:col-span-4 w-full flex justify-end px-2 md:px-0">
			<div class="flex gap-2">
				@if ($prevStepRoute)
					<a
						href="{{ route('lessons.step.show', $prevStepRoute) }}"
						class="px-4 py-2 bg-gray-200 rounded"
					>
						Previous
					</a>
				@endif

				@if ($nextStepRoute)
					<a
						href="{{ route('lessons.step.show', $nextStepRoute) }}"
						class="px-4 py-2 bg-blue-600 text-white rounded"
					>
						Next
					</a>
				@endif
			</div>
		</div>
	</main>
</x-app-layout>
<script>
	const radios = document.querySelectorAll('input[name="answer"]');
	const submitBtn = document.getElementById('submit-btn');

	radios.forEach((radio) => {
		radio.addEventListener('change', () => {
			submitBtn.disabled = ![...radios].some((r) => r.checked);
		});
	});
</script>
