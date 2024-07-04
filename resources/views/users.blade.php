
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Lista de usuarios.</p>
    @foreach ($users as $user)
        
    @endforeach
@stop

@section('css')
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

@vite('resources/js/calendar.js')