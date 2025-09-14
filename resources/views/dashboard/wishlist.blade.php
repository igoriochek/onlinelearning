@extends('dashboard.index')
<!-- t.y. naudoja dashboard layout -->

@section('dashboard-content')
	@if ($wishlists->isEmpty())
		<p class="text-gray-500">Your wishlist is empty.</p>
	@else
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
			@foreach ($wishlists as $wishlist)
				<div class="bg-white shadow rounded-lg p-4">
					<h3 class="font-bold text-lg">{{ $wishlist->course->title }}</h3>
					<p class="text-gray-600">{{ $wishlist->course->description }}</p>
					<form
						action="{{ route('dashboard.wishlist.destroy', $wishlist->course->id) }}"
						method="POST"
						class="mt-2"
					>
						@csrf
						@method('DELETE')
						<button class="text-red-600 hover:text-red-800 text-sm">
							Remove
						</button>
					</form>
				</div>
			@endforeach
		</div>
	@endif
@endsection
