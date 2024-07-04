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

        return redirect()->route('event-types.index')->with('success', 'Event Type created successfully.');
    }
}
