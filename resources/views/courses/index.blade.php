@extends('layouts.template')
@section('title', 'Courses')
@section('main')
    <h1>Courses</h1>
    <form method="get" action="/courses" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="course" id="course"
                       value="{{ request()->course }}"
                       placeholder="Filter course">
            </div>
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="programme_id" id="programme_id">
                    {{--            lists "all programmes" though a mysql wildcard (%) --}}
                    <option value="%">All programmes</option>
                    {{--                give all programmes for the dropdown--}}
                    @foreach($programmes as $programme)
                        <option value="{{ $programme->id }}"
                            {{ (request()->programme_id ==  $programme->id ? 'selected' : '') }}>{{ $programme->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 mb-2">
                <button type="submit" class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </form>
    <hr>
    @if ($courses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any course with <b>'{{ request()->course }}'</b>
            @if ( request()->programme_id != "%" )
                for this genre <b>'{{ $order[request()->programme_id-1]->name }}'</b>
            @endif
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    <div class="row">
        @foreach($courses as $course)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$course->name}}</h5>
                    <p class="card-text">{{$course->description}}</p>
                    <a href="#!">{{$course->programme->name}}</a>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="#!"
                       class="btn btn-primary btn-sm btn-block text-white">Manage students</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('script_after')
    <script>
        $(function () {
            // Add shadow to card on hover
            $('.card').hover(function () {
                $(this).addClass('shadow');
            }, function () {
                $(this).removeClass('shadow');
            });
            // submit form when leaving text field 'course'
            $('#course').blur(function () {
                $('#searchForm').submit();
            });
            // submit form when changing dropdown list 'programmid'
            $('#programme_id').change(function () {
                $('#searchForm').submit();
            });
        })
    </script>
@endsection
