<?php

use App\Http\Controllers\ApiEventController;
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

Route::get('/api/events', [ApiEventController::class, 'index']);
Route::post('/api/events', [ApiEventController::class, 'store']);
Route::put('/api/events/{event}', [ApiEventController::class, 'update']);
Route::delete('/api/events/{event}', [ApiEventController::class, 'destroy']);

Route::get('/', function () {
    $eventTypes = EventType::all();
    return view('home', compact('eventTypes'));
});
