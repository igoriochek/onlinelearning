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
  @section('title', $lesson->title . ' — Edit Step '. $step->position)
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $lesson->title }} — Edit Step {{ $step->position }}
    </h2>
    <nav class="text-sm mt-1">
      <a href="{{ route('teacher.courses.show', $lesson->section->course_id) }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        Course Overview
      </a>
      <span class="mx-1">/</span>
      <a href="{{ route('teacher.courses.sections.index', $lesson->section->course_id) }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        Sections
      </a>
      <span class="mx-1">/</span>
      <a href="{{ route('teacher.sections.lessons.index', $lesson->section->id) }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        Lessons
      </a>
      <span class="mx-1">/</span>
      <a href="{{ route('teacher.lessons.steps.index', $lesson->id) }}"
        class="inline-block text-gray-700 rounded-md font-medium hover:underline hover:text-gray-900 transition-colors duration-200">
        Steps
      </a>
      <span class="mx-1">/</span>
      <span>Edit</span>
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
        x-data="{ stepType: '{{ $step->type }}' }">
        @csrf
        @method('PUT')

        @switch($step->type)
        @case('text')
        @include('teacher.steps.partials.text-form', ['content' => $step->content])

        @break
        @case('video')
        @include('teacher.steps.partials.video-form', ['content' => $step->content])

        @break
        @case('quiz_single')
        @case('quiz_multiple')
        @include(
        'teacher.steps.partials.quiz-form',
        [
        'content' => $step->content,
        'question' => $step->question,
        'quizType' => $step->type,
        'options' => $step->options,
        ]
        )

        @break
        @default
        @endswitch

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