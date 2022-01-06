@extends('layouts.template')
@section('title', 'Courses')
@section('main')
    <h1>{{ $programmes->name }}</h1>
    {{--    need to change this check if below check is found out!!!! !!!!--}}
    @if ( $programmes->courses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            No students enrolled in this programme!
        </div>
    @else
        <div>Courses:</div>
    @endif
    <ul>
        @foreach($programmes->courses as $course)
            {{--            for the course set the enrolled students with the semester after it--}}
            <li >{{ $course->name }}</li>
        @endforeach
    </ul>
@endsection
@include('shared.footer')
