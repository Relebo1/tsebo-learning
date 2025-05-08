@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="font-size: 28px; color: #007bff;">Find Your Tutor</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('fetchAll') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <select name="subject" class="form-control">
                    <option value="">All Subjects</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject }}" {{ $selectedSubject == $subject ? 'selected' : '' }}>{{ $subject }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <select name="price" class="form-control">
                    <option value="">All Price Ranges</option>
                    <option value="low" {{ $selectedPrice == 'low' ? 'selected' : '' }}>Below 250</option>
                    <option value="medium" {{ $selectedPrice == 'medium' ? 'selected' : '' }}>250 - 500</option>
                    <option value="high" {{ $selectedPrice == 'high' ? 'selected' : '' }}>Above 500</option>
                </select>
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="row">
        @forelse($instructors as $instructor)
            <div class="col-md-4 mb-4">
                <div class="card custom-card">
                    <div class="card-img-container">
                        @if($instructor->image)
                            <img src="{{ asset('storage/profile_images/' . $instructor->image) }}" class="card-img-top" alt="Tutor Image">
                        @else
                            <img src="{{ asset('public/images/profile/default.jpg') }}" class="card-img-top" alt="Default Image">
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $instructor->fullname }}</h5>
                        <p class="card-text"><strong>Subject:</strong> {{ $instructor->subject }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $instructor->location }}</p>
                        <p class="card-text"><strong>Fee:</strong> R{{ number_format($instructor->fee, 2) }}</p>
                        <p class="card-text">{{ $instructor->bio }}</p>
                    </div>
                    <div class="card-footer text-center">
                        @auth
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bookingModal-{{ $instructor->id }}">
                                Book Tutor
                            </button>

                            <!-- Booking Modal -->
                            <div class="modal fade" id="bookingModal-{{ $instructor->id }}" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="bookingModalLabel">Book {{ $instructor->fullname }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('book.tutor', ['instructor_id' => $instructor->id]) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="booking-date" class="form-label">Booking Date</label>
                                                    <input type="date" class="form-control" name="booking_date" id="booking-date" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="booking-time" class="form-label">Booking Time</label>
                                                    <input type="time" class="form-control" name="booking_time" id="booking-time" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="Any additional information..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Confirm Booking</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p><a href="{{ route('book.tutor.form', ['instructor_id' => $instructor->id]) }}" class="btn btn-primary">Book</a>
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <p class="text-center">No tutors available for the selected filters.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    /* Card Styling */
    .custom-card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #ffffff;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* Image Container */
    .card-img-container {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-img-container img {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
    }

    /* Card Body */
    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
        color: #333333;
    }

    .card-text {
        font-size: 14px;
        color: #555555;
        margin-bottom: 10px;
    }

    /* Buttons */
    .card-footer {
        padding: 15px;
        background-color: #f7f7f7;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>
@endsection
