@php
 $stepsJson = $lesson->steps
 	->map(
 		fn ($s) => [
 			'id' => $s->id,
 			'type' => $s->type,
 			'content' => $s->question ?? '',
 		],
 	)
 	->toJson();
@endphp

<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $lesson->title }} — Steps
		</h2>

		<nav class="text-sm text-gray-500 mt-1">
			<a
				href="{{ route('teacher.courses.show', $lesson->section->course_id) }}"
				class="text-blue-500"
			>
				Course Overview
			</a>
			/
			<a
				href="{{ route('teacher.courses.sections.index', $lesson->section->course_id) }}"
				class="text-blue-500"
			>
				Sections
			</a>
			/
			<a
				href="{{ route('teacher.sections.lessons.index', $lesson->section_id) }}"
				class="text-blue-500"
			>
				Lessons
			</a>
			/ Steps
		</nav>
	</x-slot>

	<main class="max-w-7xl mx-auto py-6" x-data="stepsPage()">
		<div class="bg-white p-6 rounded-lg shadow">
			<h3 class="text-lg font-semibold mb-4">Steps</h3>

			<!-- Step tabs -->
			<div class="flex gap-2 mb-6 overflow-x-auto">
				<template x-for="(step, index) in steps" :key="step.id">
					<button
						@click="selectedStep = index"
						:class="selectedStep === index ? 'border-black' : 'border-transparent'"
						class="step-pin flex items-center justify-center w-10 h-10 rounded
							border-2 bg-gray-200 text-gray-700"
					>
						<template x-if="step.type === 'video'">
							<svg
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
								class="w-6 h-6"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"
								/>
							</svg>
						</template>
						<template x-if="step.type === 'quiz_code'">
							<svg
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="currentColor"
								class="w-6 h-6"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z"
								/>
							</svg>
						</template>
						<template
							x-if="step.type === 'quiz_single' || step.type === 'quiz_multiple'"
						>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								fill="none"
								stroke="currentColor"
								stroke-width="2"
								stroke-linecap="round"
								stroke-linejoin="round"
								class="w-6 h-6"
							>
								<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
								<path d="M12 17h.01" />
							</svg>
						</template>
					</button>
				</template>

				<button
					@click="$dispatch('open-modal', 'create-step')"
					class="step-pin w-10 h-10 rounded border-2 border-gray-300 bg-gray-100
						text-gray-500 font-bold"
				>
					+
				</button>
			</div>

			<!-- Step content -->
			<div class="border-t pt-4" x-show="steps.length > 0">
				<template x-if="selectedStep !== null">
					<div>
						<h4 class="text-md font-semibold mb-2">
							Step:
							<span x-text="steps[selectedStep].type"></span>
						</h4>

						<template x-if="steps[selectedStep].type === 'text'">
							<textarea
								class="w-full border p-2 rounded"
								placeholder="Enter text content..."
								x-model="steps[selectedStep].content"
							></textarea>
						</template>

						<template x-if="steps[selectedStep].type === 'video'">
							<input
								type="text"
								class="w-full border p-2 rounded"
								placeholder="Video URL"
								x-model="steps[selectedStep].content"
							/>
						</template>

						<template x-if="steps[selectedStep].type === 'quiz_code'">
							<textarea
								class="w-full border p-2 rounded"
								placeholder="Code/Quiz content"
								x-model="steps[selectedStep].content"
							></textarea>
						</template>

						<div class="mt-4">
							<button
								class="px-4 py-2 bg-blue-500 text-white rounded"
								@click="saveStep()"
							>
								Save Step
							</button>
						</div>
					</div>
				</template>
			</div>
		</div>
	</main>

	@include('teacher.steps.partials.create-modal')

	<script>
		function stepsPage(stepsData) {
			return {
				steps: stepsData,
				selectedStep: 0,
				saveStep() {
					const step = this.steps[this.selectedStep];
					alert(
						`Simulate saving step ${step.id} with content: ${step.content}`,
					);
				},
			};
		}
	</script>
</x-app-layout>
