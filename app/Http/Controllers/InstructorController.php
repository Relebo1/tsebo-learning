<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;




class InstructorController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.instructor.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.instructor.register');
    }


    public function store(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:instructors',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $instructor = Instructor::create([
        'fullname' => $request->full_name, // Changed from 'name' to 'full_name'
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::guard('instructor')->login($instructor);
    return redirect()->route('instructor.dashboard')->with('success', 'Instructor registered successfully.');
}




public function fetchAll(Request $request)
{
    // Initialize query to get all instructors
    $query = Instructor::query();

    // Filter by subject if it's set in the request
    if ($request->has('subject') && $request->subject != '') {
        $query->where('subject', $request->subject);
    }

    // Filter by price range if it's set in the request
    if ($request->has('price') && $request->price != '') {
        $priceRange = $request->price;
        if ($priceRange == 'low') {
            $query->where('fee', '<', 250);
        } elseif ($priceRange == 'medium') {
            $query->whereBetween('fee', [250, 500]);
        } elseif ($priceRange == 'high') {
            $query->where('fee', '>', 500);
        }
    }

    // Get the filtered or all instructors
    $instructors = $query->get();

    // Get all distinct subjects
    $subjects = Instructor::distinct()->pluck('subject');

    // Pass the data to the view
    return view('tutors', [
        'instructors' => $instructors,
        'subjects' => $subjects,
        'selectedSubject' => $request->subject,
        'selectedPrice' => $request->price,
    ]);
}



public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('instructor')->attempt($credentials)) {
        // Regenerate session for security
        $request->session()->regenerate();

        // Retrieve the authenticated instructor
        $instructor = Auth::guard('instructor')->user();

        // Ensure instructor is not null before updating
        if ($instructor) {
            $instructor->update(['is_online' => true]);
        }

        return redirect()->route('instructor.dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}





    public function dashboard()
    {
        return view('dashboards.instructor');
    }







    public function index()
{
    return view('dashboards.instructor');
}






// In InstructorController.php

public function showProfile()
{
    $instructor = auth()->user(); // Get the authenticated instructor's profile
    return view('auth.instructor.profile', compact('instructor'));
}

public function updateProfile(Request $request)
{
    $instructor = Auth::guard('instructor')->user();

    // Validate request data
    $request->validate([
        'fullname' => 'required|string|max:255',
        'subject' => 'nullable|string|max:255',
        'certifications' => 'nullable|string',
        'certificate_uploads' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'fee' => 'nullable|numeric',
        'location' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle Profile Image Upload
    if ($request->hasFile('image')) {
        // Delete old profile image if exists
        if ($instructor->image) {
            $oldImagePath = public_path('storage/profile_images/' . $instructor->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Store new image
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/profile_images', $imageName); // Store in public directory
        $instructor->image = $imageName;
    }

    // Handle Certificate Upload
    if ($request->hasFile('certificate_uploads')) {
        // Delete old certificate if exists
        if ($instructor->certificate_uploads) {
            $oldCertificatePath = public_path('storage/certificates/' . $instructor->certificate_uploads);
            if (file_exists($oldCertificatePath)) {
                unlink($oldCertificatePath);
            }
        }

        // Store new certificate
        $certificateName = time() . '_' . $request->file('certificate_uploads')->getClientOriginalName();
        $request->file('certificate_uploads')->storeAs('public/certificates', $certificateName); // Store in public directory
        $instructor->certificate_uploads = $certificateName;
    }

    // Update other profile fields
    $instructor->fullname = $request->fullname;
    $instructor->subject = $request->subject;
    $instructor->certifications = $request->certifications;
    $instructor->fee = $request->fee;
    $instructor->location = $request->location;
    $instructor->bio = $request->bio;

    // Save changes
    $instructor->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}




public function logout()
{
    $instructor = Auth::guard('instructor')->user();
    if ($instructor) {
        $instructor->update(['is_online' => false]);
    }

    Auth::guard('instructor')->logout();
    return redirect()->route('login');
}

}
