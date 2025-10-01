<x-app-layout>
	@include('lessons.partials.lesson-topbar', ['lesson' => $lesson, 'step' => $step])
	<main
		class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 py-6 px-2"
	>
		@include('lessons.partials.lesson-sidebar', ['course' => $course, 'lesson' => $lesson])
		<section
			class="md:col-span-3 bg-white shadow rounded-lg p-6"
			x-data="stepCompletion(
           	{{ $step->id }},
           	{{ in_array($step->type, ['text', 'video']) ? 1 : 0 }},
           	{{ $isCompleted ? 'true' : 'false' }},
           )"
		>
			@if ($step->type === 'text')
				<x-steps.text :step="$step" />
			@elseif ($step->type === 'video')
				<x-steps.video :step="$step" />
			@elseif ($step->type === 'quiz_code')
				<x-steps.quiz-code :step="$step" />
			@elseif (in_array($step->type, ['quiz_single', 'quiz_multiple']))
				<x-steps.quiz
					:step="$step"
					:type="$step->type === 'quiz_multiple' ? 'multiple' : 'single'"
				/>
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
