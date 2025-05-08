@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 p-0 sidebar" style="background:#007bff; color: #fff;">
            <div class="sidebar-header">
                <h3 class="text-center text-white">Student Dashboard</h3>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" style="color: #fff;">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-file-earmark"></i> My Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-person-circle"></i> My Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-chat-left-dots"></i> Forum
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-calendar-check"></i> My Schedule
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-journal-bookmark"></i> My Assignments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-credit-card"></i> My Payments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-headset"></i> Help/Support
                    </a>
                </li>
                <li class="nav-item">
                    <hr class="text-white">
                </li>
                <!-- Learning Resources Section -->
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-journal-bookmark"></i> Learning Resources
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-file-earmark-pdf"></i> PDF Guides
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-youtube"></i> Video Tutorials
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #fff;">
                        <i class="bi bi-link"></i> External Links
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger bg-dark" href="#" style="color: #fff;">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9 col-lg-10 p-4" style="margin-top: 56px;"> <!-- Added margin-top to account for fixed navbar -->
            <h2>Welcome to Your Student Dashboard</h2>
            <p>Here you can manage your courses, assignments, communication, and more!</p>

            <!-- Course List -->
            <h3>Your Courses</h3>
            <ul>
                <li>Course 1: <strong>Maths</strong></li>
                <li>Course 2: <strong>Biology </strong></li>
                <li>Course 3: <strong>Physics</strong></li>
            </ul>

            <a href="#" class="btn btn-primary">View All Courses</a>
        </div>
    </div>
</div>
@endsection
