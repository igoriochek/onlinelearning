<aside class="hidden md:block md:col-span-1">
	<nav class="bg-white shadow rounded-lg p-4 space-y-2">
		<div class="mb-4">
			<a
				href="{{ route('courses.show', $course->id) }}"
				class="block font-semibold text-lg text-gray-800 hover:text-blue-600
					transition-colors"
			>
				← {{ $course->title }}
			</a>
		</div>

		@foreach ($course->sections as $sectionIndex => $section)
			<div>
				<p class="font-semibold">
					<a
						href="{{ route('lessons.step.show', ['lesson' => $section->lessons->first()->id, 'position' => 1]) }}"
						class="hover:text-blue-600 transition-colors"
					>
						{{ $sectionIndex + 1 }}. {{ $section->title }}
					</a>
				</p>

				<ul class="ml-4 mt-1">
					@foreach ($section->lessons as $lessonIndex => $lessonItem)
						<li
							class="{{ $lesson->id === $lessonItem->id ? 'font-bold text-blue-600' : '' }}"
						>
							<a
								href="{{ route('lessons.step.show', [$lessonItem->id, 1]) }}"
								class="hover:text-blue-500 transition-colors"
							>
								{{ $sectionIndex + 1 }}.{{ $lessonIndex + 1 }}
								{{ $lessonItem->title }}
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		@endforeach
	</nav>
</aside>
