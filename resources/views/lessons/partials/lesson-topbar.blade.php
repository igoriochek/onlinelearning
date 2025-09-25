<div class="sticky top-16 bg-white shadow z-10">
	<div class="mx-auto max-w-7xl flex gap-2 px-4 py-2 overflow-x-auto">
		@foreach ($lesson->steps->sortBy('position') as $s)
			<a
				href="{{ route('lessons.step.show', ['lesson' => $lesson->id, 'position' => $s->position]) }}"
				class="step-pin px-2 py-1 rounded
					{{ $step->id === $s->id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
			>
				Step {{ $s->position }}
			</a>
		@endforeach
	</div>
</div>
