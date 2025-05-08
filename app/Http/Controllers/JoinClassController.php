<?php

namespace App\Http\Controllers;

use App\Models\Schedule; // Import the Schedule model
use Illuminate\Http\Request;

class JoinClassController extends Controller
{
    /**
     * Display the Jitsi meeting page for a class.
     *
     * @param  string  $roomName
     * @return \Illuminate\View\View
     */
    public function joinClass($roomName)
    {
        // Fetch the schedule using the room name (or use the schedule ID)
        $schedule = Schedule::where('room_name', $roomName)->first(); // You can replace 'room_name' if you're using a different field

        // If the class is not found, you can redirect or show an error page
        if (!$schedule) {
            return redirect()->route('home')->with('error', 'Class not found');
        }

        // Pass the schedule and room name to the view
        return view('join', [
            'schedule' => $schedule,
            'roomName' => $roomName
        ]);
    }
}
