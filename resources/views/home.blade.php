
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div id='calendar'></div>

    <div class="btn-group mt-3">
        <button type="button" class="btn btn-outline-primary" id="btnMonth">Mes</button>
        <button type="button" class="btn btn-outline-primary" id="btnWeek">Semana</button>
        <button type="button" class="btn btn-outline-primary" id="btnDay">Día</button>
      </div>
      
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'resourceTimelineWeek', // Vista inicial: semana
            schedulerLicenseKey: 'tu-licencia-aqui', // Reemplaza con tu clave de licencia si es necesaria
            // Otras configuraciones de FullCalendar Scheduler
          });
          calendar.render(); // Renderizar calendario
      
          // Eventos para cambiar entre las vistas
          document.getElementById('btnMonth').addEventListener('click', function() {
            calendar.changeView('dayGridMonth'); // Cambiar a vista de mes
          });
      
          document.getElementById('btnWeek').addEventListener('click', function() {
            calendar.changeView('resourceTimelineWeek'); // Cambiar a vista de semana
          });
      
          document.getElementById('btnDay').addEventListener('click', function() {
            calendar.changeView('resourceTimelineDay'); // Cambiar a vista de día
          });
        });
      </script>
    
@stop

@section('css')
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

@vite('resources/js/calendar.js')