@extends('dashboard.index')

@section('title', 'Wishlist')

@section('dashboard-content')
@if ($courses->isEmpty())
<p class="text-gray-500">Your wishlist is empty.</p>
@else
<x-course-section title="My Wishlist" :courses="$courses" />

<div class="mt-4">
  {{ $courses->links() }}
</div>
@endif
@endsection