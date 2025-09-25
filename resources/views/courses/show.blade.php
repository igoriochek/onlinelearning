<x-app-layout>
	<x-slot name="header">
		<header class="flex justify-between">
			<div class="container">
				<h1 class="text-3xl font-semibold leading-tight text-gray-800">
					{{ $course->title }}
				</h1>
				<p class="text-gray-600 mt-1">
					{{ $course->description }}
				</p>
				<div class="flex items-center mt-2 gap-2">
					<span class="text-sm text-gray-500 capitalize">
						{{ $course->level_name }} Level
					</span>
				</div>
			</div>
			<div class="flex items-center" aria-label="Course rating">
				<x-rating :value="$course->averageRating" />
				<span class="ml-2 text-gray-600 text-sm">
					{{ $course->averageRating }}/5 ({{ $course->reviews->count() }}
					reviews)
				</span>
			</div>
		</header>
	</x-slot>

	<main
		class="max-w-7xl mx-auto py-6 grid grid-cols-1 md:grid-cols-3 gap-6 px-2"
	>
		<article class="md:col-span-2">
			<img
				src="{{ $course->image_url }}"
				alt="{{ $course->title }}"
				class="rounded-lg mb-4"
				loading="lazy"
			/>

			<section aria-labelledby="learning-outcomes" class="mb-6">
				<h2 id="learning-outcomes" class="text-xl font-semibold mb-2">
					What you'll learn
				</h2>
				<ul class="list-disc ml-6 space-y-2">
					@foreach ($course->sections as $section)
						<li>{{ $section->title }}</li>
					@endforeach
				</ul>
			</section>

			<section aria-labelledby="about-course" class="mb-6">
				<h2 id="about-course" class="text-xl font-semibold mb-2">
					About this course
				</h2>
				<p>{{ $course->description }}</p>
			</section>

			<section aria-labelledby="instructor" class="mb-6">
				<h2 id="instructor" class="text-xl font-semibold mb-2">
					Meet the instructor
				</h2>
				<div class="flex items-center gap-3">
					<img
						src="{{ $course->author->avatar_url ?? 'https://placehold.co/12x12?text=Course+Author' }}"
						alt="Instructor {{ $course->author->name }}"
						class="w-12 h-12 rounded-full"
					/>
					<p class="font-medium">{{ $course->author->name }}</p>
				</div>
			</section>

			<div aria-labelledby="learning-method" class="mb-6">
				<h2 id="learning-method" class="text-xl font-semibold mb-2">
					How you will learn
				</h2>
				<ol class="list-decimal ml-6 space-y-1">
					@foreach ($course->sections as $section)
						<li>
							<strong>{{ $section->title }}</strong>
							<ul class="list-disc ml-6 text-sm text-gray-600">
								@foreach ($section->lessons->take(3) as $lesson)
									<li>{{ $lesson->title }}</li>
								@endforeach

								@if ($section->lessons->count() > 3)
									<li>
										...and {{ $section->lessons->count() - 3 }} more lessons
									</li>
								@endif
							</ul>
						</li>
					@endforeach
				</ol>
			</div>

			<section
				aria-labelledby="course-stats"
				class="mt-4 text-sm text-gray-600"
			>
				<h2 id="course-stats" class="sr-only">Course statisctics</h2>
				<p>Video Lessons: {{ $course->video_lessons_count }}</p>
				<p>Text Lessons: {{ $course->text_lessons_count }}</p>
				<p>Quizzes: {{ $course->quizzes_count }}</p>
			</section>

			<section aria-labelledby="student-reviews" class="mt-8">
				<h2 id="student-reviews" class="text-xl font-semibold mb-4">
					Student Reviews
				</h2>

				@forelse ($course->reviews as $review)
					<article class="border-b border-gray-200 pb-4 mb-4">
						<header class="flex items-center justify-between">
							<p class="font-semibold">{{ $review->user->name }}</p>
							<time
								class="text-sm text-gray-500"
								datetime="{{ $review->created_at->toDateString() }}"
							>
								{{ $review->created_at->format('M d, Y') }}
							</time>
						</header>

						<x-rating :value="$course->averageRating" size="4" class="mt-1" />

						@if ($review->comment)
							<p class="mt-2 text-gray-700">{{ $review->comment }}</p>
						@endif
					</article>
				@empty
					<p class="text-gray-500">No reviews yet.</p>
				@endforelse
			</section>
		</article>

		<aside class="hidden md:block md:col-span-1">
			<div class="md:sticky md:top-20 bg-white shadow rounded-lg p-6 space-y-2">
				<p class="text-2xl font-bold mb-2">${{ $course->price }}</p>
				<button class="bg-blue-600 text-white px-4 py-2 rounded mb-2 w-full">
					Buy now
				</button>
				<a
					href="{{ route('lessons.step.show', ['lesson' => $firstLesson->id, 'position' => 1]) }}"
					class="border border-gray-300 px-4 py-2 rounded w-full block
						text-center"
				>
					Try free trial
				</a>
				@auth
					<x-wishlist-button :course="$course" variant="full" />
				@endauth
			</div>
		</aside>
	</main>

	<nav
		class="fixed bottom-0 left-0 w-full bg-white shadow-md p-2 flex flex-col
			md:hidden"
		aria-label="Mobile purchase options"
	>
		<span class="text-lg font-bold ml-2">${{ $course->price }}</span>
		<div class="flex gap-2 justify-between">
			<button class="bg-blue-600 text-white flex-1 py-2 mx-2 rounded">
				Buy
			</button>
			<a
				href="{{ route('lessons.step.show', ['lesson' => $firstLesson->id, 'position' => 1]) }}"
				class="border border-gray-300 flex-1 py-2 mx-2 rounded block
					text-center"
			>
				Try free
			</a>
			<div class="flex gap-2">
				@auth
					<x-wishlist-button :course="$course" variant="icon" />
				@endauth
			</div>
		</div>
	</nav>
</x-app-layout>
