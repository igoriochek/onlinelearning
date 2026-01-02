<x-app-layout>
  @section('title', 'Home')
  @section('meta_description', 'Online learning platform to browse courses and improve your skills')
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Available Courses') }}
    </h2>
  </x-slot>
  <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white py-20 px-6 rounded-lg mb-12 text-center">
    <h1 class="text-4xl font-bold mb-4">Learn New Skills Online</h1>
    <p class="text-lg mb-6">Browse courses, improve your knowledge and track your progress</p>
    <a href="#" class="bg-white text-indigo-600 px-6 py-3 rounded font-semibold hover:bg-gray-100 transition">Browse All Courses</a>
  </div>

  <div class="py-6 mx-2">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <x-course-section title="Recent Courses" :courses="$recentCourses" />
      <x-course-section title="Most Popular" :courses="$popularCourses" />
      <x-course-section title="Beginner Courses" :courses="$beginnerCourses" />
      <x-course-section title="Intermediate Courses" :courses="$intermediateCourses" />
      <x-course-section title="Advanced Courses" :courses="$advancedCourses" />
    </div>
  </div>
</x-app-layout>