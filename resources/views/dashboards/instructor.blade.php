@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 p-0 sidebar" style="background:#007bff; color:#fff;">
            <div class="sidebar-header">
                <h3 class="text-white text-center">Instructor Dashboard</h3>
                <hr/>
                <p class="text-center text-white">Online: {{ Auth::guard('instructor')->user()->fullname ?? 'Instructor' }}</p>

            </div>
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link active" style="color: #fff;" href="#">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-file-earmark"></i> Courses
                    </a>
                </li>
                <li class="nav-item">   <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-person-circle"></i> Students
                    </a>
                </li>
                    <a class="nav-link" style="color: #fff;" href="{{route('instructor.profile')  }}">
                        <i class="bi bi-person-circle"></i> Update profile
                    </a>
                </li>

                <li class="nav-item">
                    <hr class="text-white">
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="{{route('instructor.schedule')  }}">
                        <i class="bi bi-calendar-check"></i> Schedule
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-chat-left-dots"></i> forum
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-credit-card"></i> Payments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-bar-chart"></i> Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " style="color: #fff;" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-headset"></i> Help/Support
                    </a>
                </li>
                <li class="nav-item">
                    <hr class="text-white">
                </li>
                <!-- Learning Resources Section -->
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-journal-bookmark"></i> Learning Resources
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-pen"></i> Assignments & Quizzes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-file-earmark-pdf"></i> PDF Guides
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-youtube"></i> Video Tutorials
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #fff;" href="#">
                        <i class="bi bi-link"></i> External Links
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger bg-dark" href="#">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="font-weight-bold text-primary">Instructor Dashboard</h2>
            <div class="online-user-section">
    <h5>Welcome, {{ Auth::guard('instructor')->user()->fullname ?? 'Instructor' }}!</h5>
    <p class="text-muted">You are currently online.</p>
</div>

            <!-- Profile Section -->
            <div class="profile-section mb-5">
                <h3>Your Profile</h3>

            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Sidebar Styles */
    .sidebar {
        background-color: #007bff;
        min-height: 100vh;
        position: fixed;
        top: 0;
        bottom: 0;
        color:#fff;
        left: 0;
        width: 250px;
        padding-top: 20px;
    }

    .sidebar-header h3 {
        color: white;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .sidebar-header a,li{
        font-weight: bold;
    }
    .nav-item {
        width: 100%;
        color:#fff;
    }

    a{
        color:#fff;
    }
    .nav-link {
        color: white;
        padding: 12px 20px;
        text-align: left;
        font-size: 16px;
        border-radius: 0;
    }

    .nav-link:hover {
        background-color: #007bff;
        color: white;
    }

    .nav-link.active {
        background-color: #007bff;
        color: white;
    }

    .nav-link.text-danger {
        color: #dc3545 !important;
    }

    /* Main Content Area */
    .main-content {
        padding-left: 270px; /* to avoid overlap with sidebar */
    }

    /* Profile Section */
    .profile-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-section h3 {
        font-weight: bold;
    }

    .profile-section ul {
        list-style-type: none;
        padding-left: 0;
    }

    .profile-section li {
        padding: 5px 0;
    }

    .profile-section input {
        width: 100%;
    }

    /* Footer */
    .footer {
        background: #007bff;
        color: white;
        text-align: center;
        padding: 15px 0;
        margin-top: 20px;
    }
</style>
@endsection
