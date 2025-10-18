@props([
  'type',
])

@php
 $stepTypes = [
 	'video' => ['icon' => 'video', 'label' => 'Video Step'],
 	'text' => ['icon' => 'text', 'label' => 'Text'],
 	'quiz_single' => ['icon' => 'quiz', 'label' => 'Single Choice Quiz'],
 	'quiz_multiple' => ['icon' => 'quiz', 'label' => 'Multiple Choice Quiz'],
 	'quiz_code' => ['icon' => 'quiz-code', 'label' => 'Code Challenge'],
 ];

 $icon = $stepTypes[$type]['icon'] ?? null;
 $label = $stepTypes[$type]['label'] ?? 'Unknown Step';
@endphp

<span class="flex items-center gap-2">
	@if ($icon)
		<span
			class="flex items-center justify-center w-10 h-10 rounded border-2
				bg-gray-200 text-gray-700"
		>
			<x-dynamic-component :component="'icons.'.$icon" />
		</span>
	@endif

	<span class="text-sm text-gray-500 ml-2">{{ $label }}</span>
</span>
