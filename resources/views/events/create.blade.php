@extends('adminlte::page')

@section('title', 'Create Event')

@section('content_header')
    <h1>Create Event</h1>
@stop

@section('content')
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="datetime-local" name="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="datetime-local" name="end_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="event_type_id">Event Type</label>
            <select name="event_type_id" class="form-control" required>
                @foreach($eventTypes as $eventType)
                    <option value="{{ $eventType->id }}">{{ $eventType->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@stop
