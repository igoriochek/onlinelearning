<x-app-layout>
  @section('title', $lesson->title . ' — Create Step')
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ $lesson->title }} — Create Step
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
      <span>Create</span>
    </nav>
  </x-slot>

  <main class="max-w-7xl mx-auto py-6">
    <div class="bg-white p-6 rounded-lg shadow">
      <h3 class="text-lg font-semibold text-gray-900 mb-6">New Step</h3>

      <form
        action="{{ route('teacher.lessons.steps.store', $lesson->id) }}"
        method="POST"
        x-data="{ stepType: '{{ old('type', 'text') }}' }">
        @csrf

        <div class="mb-4">
          <x-input-label for="type" value="Step Type" />
          <x-select-input name="type" id="type" x-model="stepType">
            <option value="text">Text / Content only (no answers)</option>
            <option value="video">Video (YouTube URL)</option>
            <option value="quiz">Multiple Choice Quiz</option>
          </x-select-input>
        </div>
        <div class="mb-4" x-show="stepType === 'text'">
          @include('teacher.steps.partials.text-form')
        </div>

        <div class="mb-4" x-show="stepType === 'video'">
          @include('teacher.steps.partials.video-form')
        </div>

        <div class="mb-4" x-show="stepType === 'quiz'">
          @include('teacher.steps.partials.quiz-form')
        </div>

        <div class="flex justify-center mt-4">
          <x-primary-button type="submit">Create Step</x-primary-button>
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