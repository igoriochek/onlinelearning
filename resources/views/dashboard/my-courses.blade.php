@extends('dashboard.index')

@section('dashboard-content')
	@if ($courses->isEmpty())
		<p class="text-gray-500">You haven't enrolled in any courses yet.</p>
	@else
		<x-course-section
			title="My Courses"
			:courses="$courses"
			:showPrice="false"
		/>
	@endif
@endsection
