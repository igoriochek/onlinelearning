<x-admin-layout>
  @section('title', __('admin.dashboard'))
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('admin.dashboard') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <x-admin.stat-card label="{{ __('admin.total_users') }}" :value="$totalUsers" color="indigo">
          <x-lucide-users class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('admin.new_users_this_month') }}" :value="$newUsersThisMonth" color="indigo">
          <x-lucide-user-plus class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('admin.active_users_this_week') }}" :value="$activeUsersThisWeek" color="indigo">
          <x-lucide-activity class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('admin.total_courses') }}" :value="$totalCourses" color="red">
          <x-lucide-book-open class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('admin.new_courses_this_month') }}" :value="$newCoursesThisMonth" color="red">
          <x-lucide-file-plus class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('admin.enrollments_this_month') }}" :value="$enrollmentsThisMonth" color="green">
          <x-lucide-graduation-cap class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('admin.average_course_rating') }}" :value="number_format($averageCourseRating, 1) . ' ★'" color="yellow">
          <x-lucide-star class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('admin.ratings_this_month') }}" :value="$ratingsThisMonth" color="orange">
          <x-lucide-message-circle class="w-6 h-6" />
        </x-admin.stat-card>
      </div>

      <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-admin.recent-users :users="$recentUsers" />
        <x-admin.recent-reviews :reviews="$recentReviews" />
        <x-admin.registrations-chart :labels="$chartLabels" :data="$chartData" />
        <x-admin.top-courses-chart :labels="$topCourseLabels" :data="$topCourseData" />
      </div>
    </div>
  </div>

</x-admin-layout>