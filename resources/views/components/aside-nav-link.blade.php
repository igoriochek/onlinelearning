@props([
  'href',
  'active' => null,
])

@php
 // Jei active neapibrėžtas, nustatom pagal dabartinį route
 $active = $active ?? request()->url() === url($href);

 $classes = $active
 	? 'block px-2 py-1 border-b-2 border-indigo-500 text-gray-900
 		transition-colors duration-150'
 	: 'block px-2 py-1 border-b-2 border-transparent text-gray-700
 		hover:border-gray-300 hover:text-gray-900 transition-colors duration-150';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
