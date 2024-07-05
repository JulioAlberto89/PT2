@extends('adminlte::page')

@section('title', 'Listado de Tipo de eventos')

@section('content_header')
    <h1>Listado de Tipo de eventos</h1>
@stop

@section('content')

    <a href="{{ route('event-types.create') }}">
        <button type="button" class="btn btn-primary">Añadir</button>
    </a>
    <table class="table">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nombre</th>
          <th scope="col">Fondo</th>
          <th scope="col">Borde</th>
          <th scope="col">Texto</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
        @foreach ($eventTypes as $eventType)
        <tr>
          <td>{{$eventType->id}}</td>
          <td>{{$eventType->name}}</td>
          <td>
            <div style="display: inline-block; width: 1em; height: 1em; background-color: {{ $eventType->background_color }}; vertical-align: middle;"></div>
            {{ $eventType->background_color }}
        </td>
        <td>
            <div style="display: inline-block; width: 1em; height: 1em; background-color: {{ $eventType->text_color }}; vertical-align: middle;"></div>
            {{ $eventType->text_color }}
        </td>
        <td>
            <div style="display: inline-block; width: 1em; height: 1em; background-color: {{ $eventType->border_color }}; vertical-align: middle;"></div>
            {{ $eventType->border_color }}
        </td>
          <td>             
             <!-- Botón para abrir el modal de edición -->
             <button type="button" data-toggle="modal" data-target="#editEventTypeModal{{ $eventType->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(12, 132, 245);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
              </button>
  
              <!-- Modal de edición para este tipo de evento -->
              <div class="modal fade" id="editEventTypeModal{{ $eventType->id }}" tabindex="-1" role="dialog" aria-labelledby="editEventTypeModalLabel{{ $eventType->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEventTypeModalLabel{{ $eventType->id }}">Editar Tipo de Evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('event-types.update', $eventType->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $eventType->name }}" required>
                                </div>
                                <div class="form-group" style="display: flex; justify-content: space-between;">
                                    <div style="flex: 1; margin-right: 10px;">
                                        <label for="background_color">Color de fondo</label>
                                        <input type="color" id="background_color" name="background_color" class="form-control jscolor" value="{{ $eventType->background_color }}" required>
                                    </div>
                                    <div style="flex: 1; margin-left: 10px;">
                                        <label for="text_color">Color de texto</label>
                                        <input type="color" id="text_color" name="text_color" class="form-control jscolor" value="{{ $eventType->text_color }}" required>
                                    </div>
                                    <div style="flex: 1; margin-left: 10px;">
                                        <label for="border_color">Color de los bordes</label>
                                        <input type="color" id="border_color" name="border_color" class="form-control jscolor" value="{{ $eventType->border_color }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
              
          </td>
          <td>
            <form action="{{ route('event-types.destroy', $eventType) }}" method="POST">
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
