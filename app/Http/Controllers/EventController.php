<?php

namespace App\Http\Controllers;
use App\Models\EventImage;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventImages;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class EventController extends Controller
{
    // Get all events
    public function dashboard()
    {
        $events = Event::all(); 
        return view('event.dashboard', compact('events'));
    }

    public function index()
    {
        $events = Event::withTrashed()->get();

        return view('event.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        return view('event.create');
    }

    // Store a newly created event in the database


    public function store(Request $request)
    {

        $request->validate([
            'event_title' => 'required',
            'event_date' => 'required|date',
            'event_description' => 'required',
            'event_location' => 'required',
            'event_category' => 'required',
            'event_time' => 'required', // Validation for event time
            'images*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image file
        ]);

        // Create the artwork
        $event = new Event();
        $event->title = $request->event_title;
        $event->date = $request->event_date;
        $event->description = $request->event_description;
        $event->location = $request->event_location;
        $event->category = $request->event_category;
        $event->time = $request->event_time;


        $event->save();

        foreach ($request->file('images') as $image) {
            // Store the image file in the storage directory and get its path
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Create a new EventImage record
            $eventImage = new EventImage();
            $eventImage->event_id = $event->id; // Associate the image with the event
            $eventImage->image_path = $imageName; // Store the file name without the directory prefix
            $eventImage->save();
        }



        return redirect()->route('event.index')->with('success', 'Artwork created successfully.');
    }


    // Show the form for editing the specified event
    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    // Update the specified event in the database

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Update event details
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'time' => $request->time,
        ]);
    
        if ($request->hasFile('images')) {
            // Delete old images associated with the event
            $event->image()->delete();
    
            // Upload and associate new images with the event
            foreach ($request->file('images') as $image) {
                // Store the image file in the storage directory and get its path
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
    
                // Create a new EventImage record
                $eventImage = new EventImage();
                $eventImage->event_id = $event->id; // Associate the image with the event
                $eventImage->image_path = $imageName; // Store the file name without the directory prefix
                $eventImage->save();
            }
        }
    
        return redirect()->route('event.index')->with('success', 'Event updated successfully');
    }
    
    

    // Remove the specified event from the database

    public function destroy($id)
    {

            $event = Event::findOrFail($id);
            $event->delete();
    
            return redirect()->route('event.index')->with('success', 'Blog deleted successfully.');
    }
    public function restore($id)
    {
        // Find the soft-deleted artwork by its ID
        $event = Event::withTrashed()->findOrFail($id);

        // Restore the soft-deleted artwork
        $event->restore();
        return redirect()->back()->with('success', 'Artwork restored successfully.');
    }

}
