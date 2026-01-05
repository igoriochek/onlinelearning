<x-app-layout>
  @section('title', __('home.title'))
  @section('meta_description', __('home.meta_description'))
  <div class="relative bg-gray-900 text-white py-20 px-6 mb-6 text-center overflow-hidden">
    <div class="absolute inset-0">
      <img
        src="{{ asset('images/hero-laptop.jpg') }}"
        alt="{{ __('home.hero_image_alt') }}"
        class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
    </div>

    <div class="relative z-10">
      <h1 class="text-4xl font-bold mb-4">
        {{ __('home.hero_title') }}
      </h1>
      <p class="text-lg mb-6">
        {{ __('home.hero_subtitle') }}
      </p>
      <a href="{{ route('courses.index') }}" class="bg-white text-gray-900 px-6 py-3 rounded font-semibold hover:bg-gray-100 transition inline-block">
        {{ __('home.browse_courses') }}
      </a>
    </div>
  </div>

  <div class="py-6 mx-2">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <x-course-section :title="__('home.sections.recent')" :courses="$recentCourses" />
      <x-course-section :title="__('home.sections.popular')" :courses="$popularCourses" />
      <x-course-section :title="__('home.sections.beginner')" :courses="$beginnerCourses" />
      <x-course-section :title="__('home.sections.intermediate')" :courses="$intermediateCourses" />
      <x-course-section :title="__('home.sections.advanced')" :courses="$advancedCourses" />
    </div>
  </div>
</x-app-layout>