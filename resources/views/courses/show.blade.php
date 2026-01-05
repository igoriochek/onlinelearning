<x-app-layout>
  @section('title', $course->title)
  @section('meta_description', Str::limit($course->description, 155))
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
          <x-badge :type="$course->level_key">
            {{ __('levels.' . $course->level_key) }}
          </x-badge>
        </div>
      </div>
      @if ($course->reviewsWithRating->count() > 0)
      <div class="flex items-center" aria-label="Course rating">
        <x-rating :value="$course->averageRating" />
        <span class="ml-2 text-gray-600 text-sm">
          {{ $course->averageRating }}/5 ({{ $course->reviewsWithRating->count() }}
          {{ __('teacher.votes') }})
        </span>
      </div>
      @endif
    </header>
  </x-slot>

  <main
    class="max-w-7xl mx-auto py-6 grid grid-cols-1 md:grid-cols-3 gap-6 px-2">
    <article class="md:col-span-2">
      <img
        src="{{ $course->image_url ? asset('storage/' . $course->image_url) : 'https://placehold.co/600x400?text=Course+Image' }}"
        alt="{{ $course->title }}"
        class="aspect-video w-full max-w-2xl object-cover rounded-lg mb-4"
        loading="lazy" />

      <section aria-labelledby="learning-outcomes" class="mb-6">
        <h2 id="learning-outcomes" class="text-xl font-semibold mb-2">
          {{ __('courses.learning_outcomes') }}
        </h2>
        <ul class="list-disc ml-6 space-y-2">
          @foreach ($course->sections as $section)
          <li>{{ $section->title }}</li>
          @endforeach
        </ul>
      </section>

      <section aria-labelledby="about-course" class="mb-6">
        <h2 id="about-course" class="text-xl font-semibold mb-2">
          {{ __('courses.about_course') }}
        </h2>
        <p>{{ $course->description }}</p>
      </section>

      <section aria-labelledby="instructor" class="mb-6">
        <h2 id="instructor" class="text-xl font-semibold mb-2">
          {{ __('courses.instructor') }}
        </h2>
        <div class="flex items-center gap-3">
          <x-avatar :user="$course->author" />
          <p class="font-medium">{{ $course->author->name }}</p>
        </div>
      </section>

      <div aria-labelledby="learning-method" class="mb-6">
        <h2 id="learning-method" class="text-xl font-semibold mb-2">
          {{ __('courses.learning_method') }}
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
                {{ __('courses.more_lessons', ['count' => $section->lessons->count() - 3]) }}
              </li>
              @endif
            </ul>
          </li>
          @endforeach
        </ol>
      </div>

      <section aria-labelledby="student-reviews" class="mt-8">
        <h2 id="student-reviews" class="text-xl font-semibold mb-4">
          {{ __('courses.student_reviews') }}
        </h2>

        @forelse ($course->approvedReviews as $review)
        <article x-data class="border-b border-gray-200 pb-4 mb-4">
          <header class="flex items-center justify-between">
            <p class="font-semibold">{{ $review->user->name }}</p>
            <time class="text-sm text-gray-500" datetime="{{ $review->created_at->toDateString() }}">
              {{ $review->created_at->format('M d, Y') }}
            </time>
          </header>

          @if($review->rating)
          <x-rating :value="$review->rating" size="4" class="mt-1" />
          @endif

          <div class="flex justify-between items-start">
            <p class="mt-2 text-gray-700">{{ $review->comment }}</p>
            @if(Auth::id() === $review->user_id)
            <div class="flex gap-x-2">
              <button
                @click="$refs['editForm{{ $review->id }}'].classList.toggle('hidden')"
                class="p-1 text-gray-700">
                <x-icons.pencil />
              </button>
              <form action="{{ route('courses.review.destroy', $review->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="p-1 text-gray-700">
                  <x-icons.trash />
                </button>
              </form>
            </div>
            @endif
          </div>

          @if(Auth::id() === $review->user_id)
          <div x-ref="editForm{{ $review->id }}" class="mt-2 hidden">
            <x-course-review-form
              :course-id="$course->id"
              :user-rating="$review->rating"
              :user-comment="$review->comment" />
          </div>
          @endif
        </article>
        @empty
        <p class="text-gray-500 mb-4">{{ __('courses.no_reviews') }}</p>
        @endforelse
        @if($isEnrolled && !$userReview)

        <div class="mb-10">
          <x-course-review-form :course-id="$course->id" />
        </div>

        @endif
      </section>
    </article>

    <aside class="hidden md:block md:col-span-1">
      <div class="md:sticky md:top-20 bg-white shadow rounded-lg p-6 space-y-4">
        @if ($isAuthor)
        @include('courses.partials.sidebar.sidebar-author')
        @elseif ($isEnrolled)
        @include('courses.partials.sidebar.sidebar-enrolled')
        @else
        @include('courses.partials.sidebar.sidebar-guest')
        @endif

        @include('courses.partials.sidebar.sidebar-includes')
      </div>
    </aside>
  </main>

  <nav
    class="fixed bottom-0 left-0 w-full bg-white shadow-md p-2 flex flex-col
			md:hidden"
    aria-label="Mobile purchase options">
    @if ($isAuthor)
    <x-primary-button
      :href="route('teacher.courses.show', $course->id)"
      class="w-full justify-center mb-2">
      {{ __('courses.manage_course') }}
    </x-primary-button>

    <x-secondary-button
      :href="route('lessons.step.show', ['lesson' => $firstLesson->id, 'position' => 1])"
      class="w-full justify-center">
      {{__('courses.preview_student')}}
    </x-secondary-button>
    @elseif ($isEnrolled)
    <x-primary-button
      :href="route('lessons.step.show', ['lesson' => $firstLesson->id, 'position' => 1])"
      class="w-full justify-center">
      {{ __('courses.continue') }}
    </x-primary-button>
    @else
    <span class="text-lg font-bold ml-2 mb-1">{{ $course->price == 0 ? __('courses.free') : __('courses.price', ['price' => $course->price]) }}</span>

    <div class="flex gap-2 justify-between">
      <form
        action="{{ route('courses.enroll', $course) }}"
        method="POST"
        class="flex-1">
        @csrf
        <x-primary-button class="w-full justify-center">{{ __('courses.enroll') }}</x-primary-button>
      </form>

      <div class="flex items-center">
        @auth
        <x-wishlist-button :course="$course" variant="icon" />
        @endauth
      </div>
    </div>
    @endif
  </nav>
</x-app-layout>