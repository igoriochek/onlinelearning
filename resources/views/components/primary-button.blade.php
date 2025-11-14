@props(['href' => null])

@if ($href)
	<a
		href="{{ $href }}"
		{{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition ease-in-out duration-150']) }}
	>
		{{ $slot }}
	</a>
@else
	<button
		{{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition ease-in-out duration-150']) }}
	>
		{{ $slot }}
	</button>
@endif
