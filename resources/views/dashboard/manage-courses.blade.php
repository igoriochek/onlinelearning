@extends('dashboard.index')

@section('dashboard-content')
	<x-course-section
		title="Created Courses"
		:courses="$courses"
		:builder="true"
	/>
@endsection
