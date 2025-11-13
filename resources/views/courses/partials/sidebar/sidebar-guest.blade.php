<div class="rounded-lg bg-gray-50 p-4 border border-gray-200 space-y-4">
	<p class="text-2xl font-bold">${{ $course->price }}</p>

	<form action="{{ route('courses.enroll', $course) }}" method="POST">
		@csrf
		<x-primary-button class="w-full justify-center">Buy Now</x-primary-button>
	</form>

	<x-secondary-button class="w-full justify-center">
		Try free trial
	</x-secondary-button>

	@auth
		<x-wishlist-button :course="$course" variant="full" />
	@endauth
</div>
