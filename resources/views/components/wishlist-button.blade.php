@props([
  'course',
  'variant' => 'text',
  'icon',
  'full',
])

<div
	x-data="{
 	inWishlist: @json($course->isInWishlist()),
 	async toggle() {
 		const url = this.inWishlist
 			? '{{ route('dashboard.wishlist.destroy', $course->id) }}'
 			: '{{ route('dashboard.wishlist.store', $course->id) }}'
 		const method = this.inWishlist ? 'DELETE' : 'POST'
 		const token = document
 			.querySelector('meta[name=csrf-token]')
 			.getAttribute('content')

 		try {
 			const res = await fetch(url, {
 				method,
 				headers: {
 					'X-CSRF-TOKEN': token,
 					'Accept': 'application/json',
 				},
 			})

 			if (res.ok) {
 				this.inWishlist = ! this.inWishlist
 				if (window.location.pathname.includes('/dashboard/wishlist')) {
 					location.reload()
 				}
 			} else {
 				console.error('Wishlist request failed')
 			}
 		} catch (e) {
 			console.error(e)
 		}
 	},
 }"
>
	@if ($variant === 'full')
		<button
			@click.prevent="toggle"
			type="button"
			class="inline-flex items-center px-4 py-2 bg-white border border-gray-300
				rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest
				shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2
				focus:ring-gray-800 focus:ring-offset-2 disabled:opacity-25 transition
				ease-in-out duration-150 w-full justify-center"
			:class="inWishlist ? 'text-red-600' : ''"
		>
			<span
				x-text="inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist'"
			></span>
		</button>
	@elseif ($variant === 'icon')
		<button
			@click.prevent="toggle"
			type="button"
			class="inline-flex items-center justify-center bg-white border
				border-gray-300 rounded-md shadow-sm p-2 hover:bg-gray-50
				focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2
				transition ease-in-out duration-150"
			:aria-label="inWishlist ? 'Remove from wishlist' : 'Add to wishlist'"
		>
			<svg
				class="w-5 h-5"
				:class="inWishlist ? 'text-red-500' : 'text-gray-400'"
				fill="currentColor"
				viewBox="0 0 24 24"
			>
				<path
					d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
               2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
               C13.09 3.81 14.76 3 16.5 3
               19.58 3 22 5.42 22 8.5
               c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
				/>
			</svg>
		</button>
	@else
		<button
			type="submit"
			@click.prevent="toggle"
			class="text-sm py-2"
			:class="inWishlist
        ? 'text-red-600 hover:text-red-800'
        : 'text-blue-600 hover:text-blue-800'"
			x-text="inWishlist ? 'Remove from Wishlist' : '+ Add to Wishlist'"
		></button>
	@endif
</div>
