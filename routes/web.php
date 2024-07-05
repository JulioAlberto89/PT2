<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\UserController;
use App\Models\Event;
use App\Models\EventType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users/add', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::resource('events', EventController::class);
Route::resource('event-types', EventTypeController::class);


// Route::get('/api/events', function() {
//     $events = Event::all()->map(function ($event) {
//         return [
//             'title' => $event->title,
//             'start' => Carbon::parse($event->start_date)->toIso8601String(),
//             'end' => Carbon::parse($event->end_date)->toIso8601String(),
//         ];
//     });
//     return response()->json($events);
// });

// Route::put('/api/events/{event}', function(Event $event, Request $request) {
//     $event->update($request->all());
//     return response()->json($event);
// });

Route::get('/api/events', function() {
    $events = Event::all()->map(function ($event) {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => Carbon::parse($event->start_date)->toIso8601String(),
            'end' => Carbon::parse($event->end_date)->toIso8601String(),
            'event_type_id' => $event->event_type_id,
        ];
    });
    return response()->json($events);
});

Route::put('/api/events/{event}', function(Event $event, Request $request) {
    $request->validate([
        'title' => 'required|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'event_type_id' => 'required|exists:event_types,id',
    ]);

    $event->update($request->all());

    return response()->json($event);
});

Route::delete('/api/events/{event}', function(Event $event) {
    $event->delete();

    return response()->json(['success' => true]);
});

Route::post('/api/events', function(Request $request) {
    $request->validate([
        'title' => 'required|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'event_type_id' => 'required|exists:event_types,id',
    ]);

    $event = Event::create($request->all());

    return response()->json($event);
});

Route::get('/', function () {
    $eventTypes = EventType::all();
    return view('home', compact('eventTypes'));
});