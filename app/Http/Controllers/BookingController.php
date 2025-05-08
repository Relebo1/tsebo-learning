<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Booking;

class BookingController extends Controller
{
    // Show the booking form for the student to fill in
    public function showBookingForm($instructor_id)
    {
        // Check if the instructor exists
        $instructor = Instructor::findOrFail($instructor_id);

        // Ensure the student is logged in
    //    if (!auth()->check()) {
     //       return redirect()->route('student.login')->with('error', 'You must be logged in to book a tutor.');
     //   }

        // Pass the instructor data to the view
        return view('booking', compact('instructor'));
    }

    // Handle the booking request submission
    public function bookTutor(Request $request)
    {
        // Validate the form input
        $request->validate([
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'message' => 'nullable|string|max:500',
            'payment_method' => 'required|string|in:mpesa,paypal',
            'mpesa_number' => 'nullable|required_if:payment_method,mpesa|string|max:15',
            'paypal_email' => 'nullable|required_if:payment_method,paypal|email',
        ]);

        // Get the logged-in student
        $student = auth()->user();

        // Get the instructor details
        $instructor = Instructor::findOrFail($request->instructor_id);

        // Create a new booking record for the student and instructor
        $booking = new Booking();
        $booking->student_id = $student->id;
        $booking->instructor_id = $instructor->id;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->message = $request->message;
        $booking->payment_method = $request->payment_method;
        $booking->status = 'pending'; // Set the initial status to pending

        // Add payment details based on the selected method
        if ($request->payment_method == 'mpesa') {
            $booking->mpesa_number = $request->mpesa_number;
        } elseif ($request->payment_method == 'paypal') {
            $booking->paypal_email = $request->paypal_email;
        }

        // Save the booking
        $booking->save();

        // Redirect to the student's dashboard with a success message
        return redirect()->route('student.dashboard')->with('success', 'Your tutor has been booked successfully!');
    }
}
