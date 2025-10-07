<div class="section border p-4 rounded relative mt-4">
	<div class="section-handle cursor-move font-bold text-gray-600 mb-2">
		☰ Section
	</div>

	<label class="block font-medium text-gray-700">Section Title</label>
	<input
		type="text"
		name="sections[{{ $index }}][title]"
		value="{{ $section['title'] ?? '' }}"
		class="mt-1 block w-full border-gray-300 rounded-md"
		required
	/>
	<input
		type="hidden"
		name="sections[{{ $index }}][position]"
		value="{{ $section['position'] ?? $index }}"
	/>
	<button
		type="button"
		onclick="this.parentElement.remove()"
		class="absolute top-2 right-2 text-red-500 font-bold text-lg"
	>
		&times;
	</button>
</div>
