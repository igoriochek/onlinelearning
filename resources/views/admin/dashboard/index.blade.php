<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <x-admin.stat-card label="{{ __('Total Users') }}" value="1,523" color="indigo">
          <x-lucide-users class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('New Users This Month') }}" value="128" color="indigo">
          <x-lucide-user-plus class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('Active Users This Week') }}" value="842" color="indigo">
          <x-lucide-activity class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('Total Courses') }}" value="74" color="red">
          <x-lucide-book-open class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('New Courses This Month') }}" value="6" color="red">
          <x-lucide-file-plus class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('Enrollments This Month') }}" value="312" color="green">
          <x-lucide-graduation-cap class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('Average Course Rating') }}" value="4.6 ★" color="yellow">
          <x-lucide-star class="w-6 h-6" />
        </x-admin.stat-card>

        <x-admin.stat-card label="{{ __('Ratings This Month') }}" value="56" color="orange">
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