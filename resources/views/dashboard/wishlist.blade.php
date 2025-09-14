@extends('dashboard.index')

@section('dashboard-content')
	@if ($courses->isEmpty())
		<p class="text-gray-500">Your wishlist is empty.</p>
	@else
		<x-course-section title="My Wishlist" :courses="$courses" />
	@endif
@endsection
