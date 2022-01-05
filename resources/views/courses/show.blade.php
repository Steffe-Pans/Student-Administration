@extends('layouts.template')
@section('title', 'Courses')
@section('main')
    <h1>{{$courses->name}}</h1>
    <p>{{$courses->description}}</p>
    @if ( $courses->studentCourses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            No students enrolled!
        </div>
    @else
        <p>List of students enrolled: </p>
    @endif

    <div class="row">
        <div class="col-sm-8">
            <ul>
                @foreach($studentCourses as $studentCourse)
                    {{--            for the course set the enrolled students with the semester after it--}}
                    <li >{{ $studentCourse->student->first_name }}
                        {{ $studentCourse->student->last_name }}
                        (semester {{ $studentCourse->semester }})</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
