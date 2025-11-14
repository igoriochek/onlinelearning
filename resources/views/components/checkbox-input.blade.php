@props([
  'name',
  'id',
  'checked' => false,
  'disabled' => false,
])

<input
	type="checkbox"
	name="{{ $name }}"
	id="{{ $id }}"
	value="1"
	@checked($checked)
	@disabled($disabled)
	{{
   $attributes->merge([
   	'class' => 'border-gray-300 focus:border-gray-800 focus:ring-gray-800 rounded shadow-sm h-5 w-5',
   ])
 }}
/>
