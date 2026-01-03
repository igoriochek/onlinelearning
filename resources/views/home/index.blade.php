<x-app-layout>
  @section('title', 'Home')
  @section('meta_description', 'Online learning platform to browse courses and improve your skills')
  <div class="relative bg-gray-900 text-white py-20 px-6 mb-6 text-center overflow-hidden">
    <div class="absolute inset-0">
      <img
        src="{{ asset('images/hero-laptop.jpg') }}"
        alt="Online Learning"
        class="w-full h-full object-cover"
        loading="lazy">
      <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
    </div>

    <div class="relative z-10">
      <h1 class="text-4xl font-bold mb-4">Learn New Skills Online</h1>
      <p class="text-lg mb-6">Browse courses, improve your knowledge and track your progress</p>
      <a href="#" class="bg-white text-gray-900 px-6 py-3 rounded font-semibold hover:bg-gray-100 transition inline-block">Browse All Courses</a>
    </div>
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