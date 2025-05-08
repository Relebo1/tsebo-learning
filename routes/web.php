<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\JoinClassController;
// Home Route
Route::get('/', function () {
    return view('home');
});


// Instructor Profile Route
Route::middleware('auth:instructor')->group(function () {
    // View Profile
    Route::get('/instructor/profile', [InstructorController::class, 'showProfile'])->name('instructor.profile');
    // Update Profile
    Route::post('/instructor/profile', [InstructorController::class, 'updateProfile'])->name('instructor.updateProfile');

    Route::get('/instructor/schedule', [ScheduleController::class, 'create'])->name('instructor.schedule');
    // Update Profile
    Route::post('/instructor/schedule', [ScheduleController::class, 'store'])->name('schedule.store');


});

Route::get('book-tutor/{instructor_id}', [BookingController::class, 'showBookingForm'])->name('book.tutor.form');
Route::post('book-tutor', [BookingController::class, 'bookTutor'])->name('book.tutor.store');

Route::middleware('auth')->get('/book/tutor', [BookingController::class, 'showTutor'])->name('book.tutor');
// Student Routes
Route::prefix('student')->group(function () {
    // Registration Routes
    Route::get('/register', [StudentController::class, 'showStudentRegister'])->name('student.register.form');
    Route::post('/register', [StudentController::class, 'register'])->name('student.register');

    // Authentication Routes
    Route::get('/login', [StudentController::class, 'showStudentLogin'])->name('student.login.form');
    Route::post('/login', [StudentController::class, 'login'])->name('student.login');

    // Dashboard and Logout Routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
        Route::post('/logout', [StudentController::class, 'logout'])->name('student.logout');

        // Book Tutor Route (Accessible only for logged-in students)
        Route::get('/book/tutor/{instructor_id}', [BookingController::class, 'bookTutor'])->name('book.tutor');
    });

    // Redirect student to login if not authenticated
    Route::get('/book/tutor/{instructor_id}', function () {
        return redirect()->route('student.login.form');
    })->name('student.book.tutor.guest');
});

// Instructor Routes
Route::prefix('instructor')->group(function () {
    // Registration Routes
    Route::get('/register', [InstructorController::class, 'showRegistrationForm'])->name('instructor.register');
    Route::post('/register', [InstructorController::class, 'store']);

    // Authentication Routes
    Route::get('/login', [InstructorController::class, 'showLoginForm'])->name('instructor.login');
    Route::post('/login', [InstructorController::class, 'login']);

    // Instructor Dashboard and Logout Routes
    Route::middleware('auth:instructor')->group(function () {
        Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');
        Route::post('/logout', [InstructorController::class, 'logout'])->name('instructor.logout');
    });
});

// Tutors Route for Fetching All Instructors with Filters
Route::get('/tutors', [InstructorController::class, 'fetchAll'])->name('fetchAll');

// Booking Routes (Consider adding a resource route for booking)
Route::resource('bookings', BookingController::class);


Route::resource('schedules', ScheduleController::class);
Route::get('classes/join/{schedule}', [ScheduleController::class, 'join'])->name('classes.join');
Route::get('instructor/schedule', [ScheduleController::class, 'index'])->name('instructor.schedule');




Route::get('/class/{roomName}', [JoinClassController::class, 'joinClass'])->name('class.join');
Route::get('/class/{roomName}', [JoinClassController::class, 'joinClass'])->name('schedules.join');
