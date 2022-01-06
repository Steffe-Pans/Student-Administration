@extends('layouts.template')

@section('title', 'Edit programme')

@section('main')
    <h1>Edit programme: {{ $programmes->name }}</h1>
    <form action="/admin/programmes/{{ $programmes->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   minlength="3"
                   required
                   value="{{ old('name', $programmes->name ?? '') }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save programme</button>
    </form>
@endsection
