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
          <th scope="col">Acciones</th>
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
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editEventTypeModal{{ $eventType->id }}">
                Editar
              </button>
  
              <!-- Modal de edición para este tipo de evento -->
              <div class="modal fade" id="editEventTypeModal{{ $eventType->id }}" tabindex="-1" role="dialog" aria-labelledby="editEventTypeModalLabel{{ $eventType->id }}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="editEventTypeModalLabel{{ $eventType->id }}">Editar Tipo de Evento</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
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
                                  <div class="form-group">
                                      <label for="background_color">Color de fondo</label>
                                      <input type="color" id="background_color" name="background_color" class="form-control jscolor" value="{{ $eventType->background_color }}" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="text_color">Color de texto</label>
                                      <input type="color" id="text_color" name="text_color" class="form-control jscolor" value="{{ $eventType->text_color }}" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="border_color">Color de los bordes</label>
                                      <input type="color" id="border_color" name="border_color" class="form-control jscolor" value="{{ $eventType->border_color }}" required>
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
              
            <form action="{{ route('event-types.destroy', $eventType) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-900">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M16 1.75V3h5.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75Zm-6.5 0V3h5V1.75a.25.25 0 0 0-.25-.25h-4.5a.25.25 0 0 0-.25.25ZM4.997 6.178a.75.75 0 1 0-1.493.144L4.916 20.92a1.75 1.75 0 0 0 1.742 1.58h10.684a1.75 1.75 0 0 0 1.742-1.581l1.413-14.597a.75.75 0 0 0-1.494-.144l-1.412 14.596a.25.25 0 0 1-.249.226H6.658a.25.25 0 0 1-.249-.226L4.997 6.178Z"></path><path d="M9.206 7.501a.75.75 0 0 1 .793.705l.5 8.5A.75.75 0 1 1 9 16.794l-.5-8.5a.75.75 0 0 1 .705-.793Zm6.293.793A.75.75 0 1 0 14 8.206l-.5 8.5a.75.75 0 0 0 1.498.088l.5-8.5Z"></path></svg>
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
