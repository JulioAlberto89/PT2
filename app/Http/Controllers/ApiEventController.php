<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    public function index()
    {
        $events = Event::with('eventType')->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => Carbon::parse($event->start_date)->toIso8601String(),
                'end' => Carbon::parse($event->end_date)->toIso8601String(),
                'event_type_id' => $event->event_type_id,
                'backgroundColor' => $event->eventType->background_color,
                'borderColor' => $event->eventType->border_color,
                'textColor' => $event->eventType->text_color,
            ];
        });
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'event_type_id' => 'required|exists:event_types,id',
        ]);

        $event = Event::create($request->all());

        return response()->json($event);
    }

    public function update(Event $event, Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'event_type_id' => 'required|exists:event_types,id',
        ]);

        $event->update($request->all());

        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        if ($event) {
            $event->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }
    }
}
