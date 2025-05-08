<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('auth.instructor.schedule', compact('schedules'));
    }

    public function create()
    {
        return view('auth.instructor.schedule');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'days' => 'required|array|min:1',
            'days.*' => 'string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_name' => 'required|string|max:255',
        ]);

        $instructorId = Auth::guard('instructor')->id();

        if (!$instructorId) {
            return redirect()->route('schedules.index')->with('error', 'Unauthorized instructor.');
        }

        $schedules = array_map(function ($day) use ($validated, $instructorId) {
            return [
                'instructor_id' => $instructorId,
                'subject' => $validated['subject'],
                'day' => $day,
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'room_name' => $validated['room_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $validated['days']);

        try {
            Schedule::insert($schedules);
            $this->addToGoogleCalendar($schedules);
            return redirect()->route('schedules.index')->with('success', 'Schedule created successfully!');
        } catch (\Exception $e) {
            Log::error('Error inserting schedule: ' . $e->getMessage());
            return redirect()->route('schedules.index')->with('error', 'Failed to create schedule.');
        }
    }

    private function addToGoogleCalendar($schedules)
    {
        try {
    $client = new Client();
    $client->setAuthConfig(storage_path('app/google-calendar-credentials.json'));
    $client->setScopes(Calendar::CALENDAR_EVENTS);

    $service = new Calendar($client);
    $calendarId = config('google-calendar.calendar_id');

    foreach ($schedules as $schedule) {
        $event = new Event([
            'summary' => $schedule['subject'],
            'start' => ['dateTime' => Carbon::parse("next {$schedule['day']} {$schedule['start_time']}")->toIso8601String()],
            'end' => ['dateTime' => Carbon::parse("next {$schedule['day']} {$schedule['end_time']}")->toIso8601String()],
            'timeZone' => 'Africa/Johannesburg',
        ]);

        $createdEvent = $service->events->insert($calendarId, $event);

        // ✅ Log success
        Log::info('Google Calendar event created:', ['eventId' => $createdEvent->id]);
    }
} catch (\Exception $e) {
    // ❌ Log error
    Log::error('Google Calendar API error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
}

    }

    public function show(Schedule $schedule)
    {
        return view('auth.instructor.showSchedule', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('auth.instructor.edit_schedule', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'subject' => 'sometimes|string|max:255',
            'days' => 'sometimes|array|min:1',
            'days.*' => 'string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'sometimes|date_format:H:i',
            'end_time' => 'sometimes|date_format:H:i|after:start_time',
            'room_name' => 'sometimes|string|max:255',
        ]);

        try {
            $schedule->update($validated);
            return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating schedule: ' . $e->getMessage());
            return redirect()->route('schedules.index')->with('error', 'Failed to update schedule.');
        }
    }

    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();
            return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting schedule: ' . $e->getMessage());
            return redirect()->route('schedules.index')->with('error', 'Failed to delete schedule.');
        }
    }
}
