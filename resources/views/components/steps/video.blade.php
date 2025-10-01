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
	<div class="aspect-video">
		<iframe
			src="https://www.youtube.com/embed/{{ $videoId }}"
			title="Video step"
			frameborder="0"
			allowfullscreen
			class="w-full h-full rounded"
		></iframe>
	</div>
@else
	<p class="text-red-500">No video available for this step.</p>
@endif
