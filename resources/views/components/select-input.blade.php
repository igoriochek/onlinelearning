@props([
  'name',
  'id',
  'disabled' => false,
])

<select
	name="{{ $name }}"
	id="{{ $id }}"
	@disabled($disabled)
	{{
   $attributes->merge([
   	'class' => 'border-gray-300 focus:border-gray-800 focus:ring-gray-800 rounded-md shadow-sm block w-full mt-1',
   ])
 }}
>
	{{ $slot }}
</select>
