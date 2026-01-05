@extends('dashboard.index')

@section('title', __('dashboard.my_courses'))

@section('dashboard-content')
@if ($courses->isEmpty())
<p class="text-gray-500">{{ __('dashboard.my_courses_empty') }}</p>
@else
<x-course-section
  :title="__('dashboard.my_courses')"
  :courses="$courses"
  :showPrice="false" />

<div class="mt-4">
  {{ $courses->links() }}
</div>
@endif
@endsection