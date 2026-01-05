@extends('dashboard.index')

@section('title', __('dashboard.wishlist'))

@section('dashboard-content')
@if ($courses->isEmpty())
<p class="text-gray-500">{{ __('dashboard.wishlist_empty') }}</p>
@else
<x-course-section
  :title="__('dashboard.wishlist')" :courses="$courses" />

<div class="mt-4">
  {{ $courses->links() }}
</div>
@endif
@endsection