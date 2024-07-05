@extends('adminlte::page')

@section('title', 'Create Event Type')

@section('content_header')
    <h1>Create Event Type</h1>
@stop

@section('content')
    <form action="{{ route('event-types.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group" style="display: flex; justify-content: space-between;">
            <div style="flex: 1; margin-right: 10px;">
                <label for="background_color">Color de fondo</label>
                <input type="color" name="background_color" class="form-control" required>
            </div>
            <div style="flex: 1; margin-left: 10px;">
                <label for="text_color">Color de texto</label>
                <input type="color" name="text_color" class="form-control" required>
            </div>
            <div style="flex: 1; margin-left: 10px;">
                <label for="border_color">Color de los bordes</label>
                <input type="color" name="border_color" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@stop
