<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			{{ $course->title }} — Sections
		</h2>
	</x-slot>

	<main class="max-w-5xl mx-auto py-6">
		<div class="bg-white p-6 rounded-lg shadow">
			<h3 class="text-lg font-semibold mb-4">Sections</h3>
			<p class="text-gray-600 mb-4">
				Here you will manage your course sections.
			</p>
		</div>
	</main>
</x-app-layout>
