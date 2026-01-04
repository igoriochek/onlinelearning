@extends('dashboard.index')

@section('title', 'My Courses')

@section('dashboard-content')
@if ($courses->isEmpty())
<p class="text-gray-500">You haven't enrolled in any courses yet.</p>
@else
<x-course-section
  title="My Courses"
  :courses="$courses"
  :showPrice="false" />

<div class="mt-4">
  {{ $courses->links() }}
</div>
@endif
@endsection