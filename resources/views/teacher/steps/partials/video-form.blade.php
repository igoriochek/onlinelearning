@props(['content' => null])

<x-input-label for="content_video" :value="__('teacher.video_url_label')" />

<x-text-input
  id="content_video"
  type="text"
  name="content_video"
  class="w-full"
  placeholder="{{ $content ? __('teacher.video_current') . ': ' . $content : __('teacher.video_url_placeholder') }}"
  value="{{ old('content_video', $content ?? '') }}"
  x-bind:disabled="stepType !== 'video'"
  x-bind:required="stepType === 'video'"
  pattern="https?://(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/.+" />

<x-input-error :messages="$errors->get('content_video')" class="mt-1" />

@if ($content && Str::contains($content, ['youtube.com', 'youtu.be']))
@php
preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([A-Za-z0-9_-]+)/', $content, $matches);
$videoId = $matches[1] ?? null;
@endphp

@if ($videoId)
<div class="mt-6">
  <div class="overflow-hidden bg-white max-w-md mx-auto">
    <figure>
      <figcaption class="text-center text-sm text-gray-500 mt-2">
        {{ __('teacher.video_current') }}
      </figcaption>
      <a href="{{ $content }}" target="_blank" rel="noopener noreferrer">
        <img
          src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
          alt="{{ __('teacher.video_current') }}"
          class="w-full h-auto object-cover" />
      </a>
    </figure>
  </div>
</div>
@endif
@endif

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('content_video');
    const defaultValue = input.value;

    input.addEventListener('focus', function() {
      if (input.value === defaultValue) {
        input.select();
      }
    });
  });
</script>