<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('dashboard.heading') }}
    </h2>
  </x-slot>

  <div class="py-6 mx-2">
    <div
      class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
      <aside
        class="hidden md:block w-44 bg-white shadow-sm rounded-lg p-4 h-60">
        <nav class="space-y-2">
          <x-aside-nav-link
            href="{{ route('dashboard.my-courses') }}"
            :active="request()->routeIs('dashboard.my-courses')">
            {{ __('dashboard.my_courses') }}
          </x-aside-nav-link>

          <x-aside-nav-link
            href="{{ route('dashboard.wishlist') }}"
            :active="request()->routeIs('dashboard.wishlist')">
            {{ __('dashboard.wishlist') }}
          </x-aside-nav-link>
          @auth
          @if (auth()->user()->role === 'teacher')
          <x-aside-nav-link
            href="{{ route('dashboard.manage-courses') }}"
            :active="request()->routeIs('dashboard.manage-courses')">
            {{ __('dashboard.manage_courses') }}
          </x-aside-nav-link>
          @endif
          @endauth
        </nav>
      </aside>
      <nav
        class="md:hidden bg-white shadow p-2 flex justify-around mb-4
					rounded-lg">
        <x-aside-nav-link
          href="{{ route('dashboard.my-courses') }}"
          :active="request()->routeIs('dashboard.my-courses')">
          {{ __('dashboard.my_courses') }}
        </x-aside-nav-link>

        <x-aside-nav-link
          href="{{ route('dashboard.wishlist') }}"
          :active="request()->routeIs('dashboard.wishlist')">
          {{ __('dashboard.wishlist') }}
        </x-aside-nav-link>
        @if (auth()->user()->role === 'teacher')
        <x-aside-nav-link
          href="{{ route('dashboard.manage-courses') }}"
          :active="request()->routeIs('dashboard.manage-courses')">
          {{ __('dashboard.manage_courses') }}
        </x-aside-nav-link>
        @endif
      </nav>
      <main class="flex-1">
        @yield('dashboard-content')
      </main>
    </div>
  </div>
</x-app-layout>