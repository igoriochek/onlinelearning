<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-6">
			<!-- Sidebar -->
			<aside class="w-64 bg-white shadow-sm rounded-lg p-4 flex-shrink-0">
				<nav class="space-y-2">
					<a
						href="{{ route('dashboard') }}"
						class="block px-2 py-1 rounded hover:bg-gray-100"
					>
						Overview
					</a>
					<a
						href="{{ route('dashboard.wishlist') }}"
						class="block px-2 py-1 rounded hover:bg-gray-100"
					>
						Wishlist
					</a>
					<!-- Galima pridėti Bought Courses, Finished Courses -->
				</nav>
			</aside>
			<main class="flex-1">
				@yield('dashboard-content')
			</main>
		</div>
	</div>
</x-app-layout>
