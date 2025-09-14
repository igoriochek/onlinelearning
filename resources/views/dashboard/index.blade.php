<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-6">
			<aside class="w-44 bg-white shadow-sm rounded-lg p-4 h-28">
				<nav class="space-y-2">
					<x-aside-nav-link
						href="{{ route('dashboard') }}"
						:active="request()->routeIs('dashboard')"
					>
						Overview
					</x-aside-nav-link>

					<x-aside-nav-link
						href="{{ route('dashboard.wishlist') }}"
						:active="request()->routeIs('dashboard.wishlist')"
					>
						Wishlist
					</x-aside-nav-link>
				</nav>
			</aside>
			<main class="flex-1">
				@yield('dashboard-content')
			</main>
		</div>
	</div>
</x-app-layout>
