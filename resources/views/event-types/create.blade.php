@extends('adminlte::page')

@section('title', 'Create Event Type')

@section('content_header')
    <h1>Create Event Type</h1>
@stop

@section('content')
    <form action="{{ route('event-types.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="background_color">Background Color</label>
            <input type="text" name="background_color" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="text_color">Text Color</label>
            <input type="text" name="text_color" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="border_color">Border Color</label>
            <input type="text" name="border_color" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@stop
