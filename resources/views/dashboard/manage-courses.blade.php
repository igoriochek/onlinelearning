@extends('dashboard.index')

@section('title', __('dashboard.manage_courses'))

@section('dashboard-content')
<x-course-section
  :title="__('dashboard.created_courses')"
  :courses="$courses"
  :builder="true" />

<div class="mt-4">
  {{ $courses->links() }}
</div>
@endsection