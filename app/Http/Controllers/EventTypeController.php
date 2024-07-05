<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function index()
    {
        $eventTypes = EventType::all();
        return view('event-types.index', compact('eventTypes'));
    }

    public function create()
    {
        return view('event-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'background_color' => 'required|max:7',
            'text_color' => 'required|max:7',
            'border_color' => 'required|max:7',
        ]);

        EventType::create($request->all());

        return redirect()->route('event-types.index')->with('success', 'Tipo de evento creado correctamente.');
    }

    public function edit(EventType $eventType){
        return view('users-index', ['eventType' => $eventType]);
    }

    public function update(Request $request, EventType $eventType)
    {
        $request->validate([
            'name' => 'required|max:255',
            'background_color' => 'required|max:7',
            'text_color' => 'required|max:7',
            'border_color' => 'required|max:7',
        ]);

        try{
            $eventType->update([
                'name' => $request->name,
                'background_color' => $request->background_color,
                'text_color' => $request->text_color,
                'border_color' => $request->border_color,
            ]);

            return redirect()->route('event-types.index')->with('success', 'Tipo de evento editado correctamente.');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    public function destroy(EventType $eventType)
    {
        $eventType->delete();
        return redirect()->route('event-types.index')->with('success', 'Tipo de evento eliminado correctamente');
    }
}
