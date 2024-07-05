<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\UserController;
use App\Models\Event;
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


Route::get('/api/events', function() {
    $events = Event::all()->map(function ($event) {
        return [
            'title' => $event->title,
            'start' => Carbon::parse($event->start_date)->toIso8601String(),
            'end' => Carbon::parse($event->end_date)->toIso8601String(),
        ];
    });
    return response()->json($events);
});

Route::put('/api/events/{event}', function(Event $event, Request $request) {
    $event->update($request->all());
    return response()->json($event);
});