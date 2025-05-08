<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    // Show Student Registration Form
    public function showStudentRegister()
    {
        return view('auth.student.register');  // Ensure this Blade file exists
    }

    // Handle Student Registration
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $student = Student::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($student);
            return redirect()->route('student.dashboard')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            Log::error('Student Registration Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed. Try again.']);
        }
    }

    // Show Student Login Form
    public function showStudentLogin()
    {
        return view('auth.student.login');
    }

    // Handle Student Login
    public function login(Request $request)
    {
        // Validate login fields
        $request->validate([
            'email' => 'required|email', // Ensure email is provided and valid
            'password' => 'required',    // Ensure password is provided
        ]);

        // Attempt to authenticate the student by checking credentials in the 'students' table
        $student = Student::where('email', $request->email)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            // Successful authentication, log the student in
            Auth::login($student);

            // Redirect to the desired page after successful login
            return redirect()->route('fetchAll');  // You can change this to any route you need
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors(['error' => 'Invalid credentials. Please try again.']);
    }

    // Show Student Dashboard (Only Accessible When Logged In)
    public function index()
    {
        $student = Auth::user();
        return view('dashboards.student', compact('student'));
    }
}
