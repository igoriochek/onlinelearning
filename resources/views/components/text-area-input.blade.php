@props([
  'name',
  'id',
  'rows' => 4,
  'disabled' => false,
])

<textarea
	name="{{ $name }}"
	id="{{ $id }}"
	rows="{{ $rows }}"
	@disabled($disabled)
	{{
   $attributes->merge([
   	'class' => 'border-gray-300 focus:border-gray-800 focus:ring-gray-800 rounded-md shadow-sm block w-full mt-1',
   ])
 }}
>
{{ $slot ?? old($name) }}</textarea
>
