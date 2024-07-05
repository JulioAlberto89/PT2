
@extends('adminlte::page')

@section('title', 'Listado de Usuarios')

@section('content_header')
    <h1>Listado de Usuarios</h1>
@stop

@section('content')

    <a href="{{ route('users.create') }}">
        <button type="button" class="btn btn-primary">Añadir</button>
    </a>
    <table class="table">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Login</th>
          <th scope="col">Email</th>
          <th scope="col">Activada</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
        @foreach ($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->username}}</td>
          <td>{{$user->email}}</td>
          <td>
            @if ($user->type == 'admin')
                Sí
            @else
                No
            @endif
          </td>
          <td style="display: flex; align-items: center;">
            <button type="submit">
            <a href="{{ route('users.edit', $user->id) }}" class="text-red-600 hover:text-red-900" style="margin-right: 10px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(12, 132, 245);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
            </a>
            </button>
          </td>
          <td>
            <form action="{{ route('users.destroy', $user) }}" method="POST" style="margin-left: 10px;">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-900">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(255, 0, 0);transform: ;msFilter:;"><path d="M15 2H9c-1.103 0-2 .897-2 2v2H3v2h2v12c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V8h2V6h-4V4c0-1.103-.897-2-2-2zM9 4h6v2H9V4zm8 16H7V8h10v12z"></path></svg>
              </button>
            </form>
          </td>
        </tr>
    @endforeach
    </table>
@stop

@section('css')
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

@vite('resources/js/calendar.js')
