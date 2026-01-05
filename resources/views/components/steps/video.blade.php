@props([
'step',
])

@php
$videoId = null;
if ($step->content) {
preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_-]+)/', $step->content, $matches);
if (isset($matches[1])) {
$videoId = $matches[1];
}
}
@endphp

@if ($videoId)
<div
  class="aspect-video bg-gray-100 flex items-center justify-center rounded-lg
			overflow-hidden">
  <iframe
    src="https://www.youtube.com/embed/{{ $videoId }}"
    title="{{ __('courses.lesson.video_step') }}"
    class="w-full h-full"
    allowfullscreen></iframe>
  <noscript>
    <img
      src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
      alt="Video thumbnail" />
  </noscript>
</div>
<p class="text-xs text-gray-500 mt-2">
  {{ __('courses.lesson.video_embed_warning') }}
</p>
@else
<p class="text-red-500">{{ __('courses.lesson.no_video') }}</p>
@endif