<?php
namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index(Request $request)
    {
        $selectedSubject = $request->input('subject');
        $selectedPrice = $request->input('price');

        // Query tutors from the database
        $tutorsQuery = Tutor::query();

        // Filter by subject if selected
        if ($selectedSubject) {
            $tutorsQuery->where('subject', $selectedSubject);
        }

        // Filter by price range
        if ($selectedPrice) {
            if ($selectedPrice === 'low') {
                $tutorsQuery->where('price', '<', 250);
            } elseif ($selectedPrice === 'medium') {
                $tutorsQuery->whereBetween('price', [250, 500]);
            } elseif ($selectedPrice === 'high') {
                $tutorsQuery->where('price', '>', 500);
            }
        }

        // Get the filtered tutors
        $tutors = $tutorsQuery->get();

        // Get unique subjects for the filter dropdown
        $subjects = Tutor::distinct()->pluck('subject');

        return view('tutors.index', compact('tutors', 'subjects', 'selectedSubject', 'selectedPrice'));
    }
}
