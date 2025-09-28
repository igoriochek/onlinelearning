<div class="sticky top-16 bg-white shadow">
	<div class="mx-auto max-w-7xl flex gap-2 px-4 py-2 overflow-x-auto">
		@foreach ($lesson->steps->sortBy('position') as $s)
			<a
				href="{{ route('lessons.step.show', ['lesson' => $lesson->id, 'position' => $s->position]) }}"
				class="step-pin flex items-center justify-center w-10 h-10 rounded
					{{ $step->id === $s->id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
			>
				@if ($s->type === 'video')
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
				@elseif ($s->type === 'quiz_code')
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
				@endif
			</a>
		@endforeach
	</div>
</div>
