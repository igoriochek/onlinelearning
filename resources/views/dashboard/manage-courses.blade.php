@extends('dashboard.index')

@section('title', 'Manage Courses')

@section('dashboard-content')
<x-course-section
  title="Created Courses"
  :courses="$courses"
  :builder="true" />

<div class="mt-4">
  {{ $courses->links() }}
</div>
@endsection