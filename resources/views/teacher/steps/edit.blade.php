@php
 $stepTypeLabels = [
 	'text' => 'Text',
 	'video' => 'Video',
 	'quiz_single' => 'Single Choice Quiz',
 	'quiz_multiple' => 'Multiple Choice Quiz',
 	'quiz_code' => 'Code Quiz',
 ];
@endphp

<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $lesson->title }} — Edit Step
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
				href="{{ route('teacher.sections.lessons.index', $lesson->section->id) }}"
				class="text-blue-500"
			>
				Lessons
			</a>
			/
			<a
				href="{{ route('teacher.lessons.steps.index', $lesson->id) }}"
				class="text-blue-500"
			>
				Steps
			</a>
			/ Edit
		</nav>
	</x-slot>

	<main class="max-w-7xl mx-auto py-6">
		<div class="bg-white p-6 rounded-lg shadow">
			<h3 class="text-lg font-semibold text-gray-900 mb-6">
				Edit {{ $stepTypeLabels[$step->type] ?? ucfirst($step->type) }} Step
			</h3>

			<form
				action="{{ route('teacher.steps.update', $step->id) }}"
				method="POST"
			>
				@csrf
				@method('PUT')

				@if ($step->type === 'text')
					@include('teacher.steps.partials.text-form', ['content' => $step->content])
				@elseif ($step->type === 'video')
					@include('teacher.steps.partials.video-form', ['content' => $step->content])
				@endif

				<div class="flex justify-center mt-4">
					<x-primary-button type="submit">Update Step</x-primary-button>
				</div>
			</form>
		</div>
	</main>
</x-app-layout>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<style>
	.ck-editor__editable_inline {
		min-height: 200px;
	}
</style>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		document.querySelectorAll('.editor').forEach((el) => {
			ClassicEditor.create(el).catch((error) =>
				console.error('CKEditor init error:', error),
			);
		});
	});
</script>
