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
    <h2>Add a new course to {{$programmes->name}}</h2>
    <form action="/admin/create" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   minlength="3"
                   required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="name">Description</label>
            <input type="text" name="description" id="description"
                   class="form-control @error('description') is-invalid @enderror"
                   placeholder="Description"
                   minlength="3"
                   required>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Add course</button>
    </form>
@endsection
@include('shared.footer')
