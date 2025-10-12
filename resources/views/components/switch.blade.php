@props([
	'checked' => false,
	'action' => '#',
	'id' => null,
])

<form action="{{ $action }}" method="POST" class="inline-block switch-form">
	@csrf
	<label class="relative inline-block w-14 h-6 cursor-pointer select-none">
		<input
			id="{{ $id }}"
			type="checkbox"
			{{ $checked ? 'checked' : '' }}
			class="sr-only peer switch-input"
		/>
		<div
			class="w-12 h-6 bg-gray-300 rounded-full shadow-inner transition-colors
				duration-200 peer-checked:bg-gray-800"
		></div>
		<div
			class="dot absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow
				transform transition-transform duration-200 peer-checked:translate-x-6"
		></div>
		<span
			class="absolute left-6 top-1 text-xs text-gray-600 pointer-events-none
				peer-checked:hidden font-semibold"
		>
			OFF
		</span>
		<span
			class="absolute left-0.5 top-1 text-xs text-white pointer-events-none
				hidden peer-checked:block font-semibold"
		>
			ON
		</span>
	</label>
</form>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		document.querySelectorAll('.switch-form').forEach((form) => {
			const input = form.querySelector('.switch-input');

			input.addEventListener('change', () => {
				const formData = new FormData(form);

				fetch(form.action, {
					method: 'POST',
					headers: { 'X-Requested-With': 'XMLHttpRequest' },
					body: formData,
				})
					.then((res) => res.json())
					.then((data) => {
						console.log('Status updated:', data.public);
					})
					.catch((err) => {
						alert('Error updating status');
						input.checked = !input.checked;
					});
			});
		});
	});
</script>
