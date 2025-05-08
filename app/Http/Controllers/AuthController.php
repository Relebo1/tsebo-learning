<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.instructor.login');
    }






    public function login(Request $request)
{
    // Get email and password from the request
    $credentials = $request->only('email', 'password');

    // Attempt to authenticate the instructor
    $instructor = Instructor::where('email', $credentials['email'])->first();

    if ($instructor && Hash::check($credentials['password'], $instructor->password)) {
        // Authentication successful, log the instructor in
        Auth::login($instructor);
        return redirect()->intended('dashboards.instructor');  
    }

    // If authentication fails, return back with an error
    return back()->withErrors(['error' => 'Invalid login credentials']);
}




    public function showInstructorRegister()
    {
        return view('auth.instructor.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|in:student,instructor',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        if ($data['type'] === 'student') {
            Student::create(['user_id' => $user->id, 'grade_level' => $request->grade_level]);
        } elseif ($data['type'] === 'instructor') {
            Instructor::create([
                'user_id' => $user->id,
                'subject' => $request->subject,
                'experience' => $request->experience,
                'hourly_rate' => $request->hourly_rate,
            ]);
        }

        return redirect()->route('login')->with('success', 'Registration successful.');
    }

    public function logout(){
        return view ('auth.instructor.login');
    }
}
