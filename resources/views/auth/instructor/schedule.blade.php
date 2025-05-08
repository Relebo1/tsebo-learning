@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4 text-primary">Instructor Schedule</h2>
            <div class="card shadow-lg p-4 rounded">
                <form method="POST" action="{{ route('schedules.store') }}">
                    @csrf

                    <!-- Subject Field -->
                    <div class="form-group mb-4">
                        <label for="subject" class="form-label font-weight-bold">Subject:</label>
                        <input type="text" name="subject" class="form-control form-control-lg" placeholder="Enter subject" required>
                    </div>

                    <!-- Days Available -->
                    <div class="form-group mb-4">
                        <label for="days" class="form-label font-weight-bold">Available Days:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Monday" id="monday">
                                    <label class="form-check-label" for="monday">Monday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Wednesday" id="wednesday">
                                    <label class="form-check-label" for="wednesday">Wednesday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Friday" id="friday">
                                    <label class="form-check-label" for="friday">Friday</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Tuesday" id="tuesday">
                                    <label class="form-check-label" for="tuesday">Tuesday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Thursday" id="thursday">
                                    <label class="form-check-label" for="thursday">Thursday</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="Saturday" id="saturday">
                                    <label class="form-check-label" for="saturday">Saturday</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Start Time -->
                    <div class="form-group mb-4">
                        <label for="start_time" class="form-label font-weight-bold">Start Time:</label>
                        <input type="time" name="start_time" class="form-control form-control-lg" required>
                    </div>

                    <!-- End Time -->
                    <div class="form-group mb-4">
                        <label for="end_time" class="form-label font-weight-bold">End Time:</label>
                        <input type="time" name="end_time" class="form-control form-control-lg" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">Submit Schedule</button>
                </form>
            </div>

            <!-- Schedule Table -->
            <div class="card shadow-lg p-4 mt-4 rounded">
                <h4 class="text-center mb-4">Scheduled Classes</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Days</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->subject }}</td>
                                <td>{{ $schedule->days }}</td>
                                <td>{{ $schedule->start_time }}</td>
                                <td>{{ $schedule->end_time }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                    <!-- Join Class Button -->
                                    <a href="{{ route('schedules.join', $schedule->id) }}" class="btn btn-success btn-sm">Join</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f7fc;
    }

    .container {
        max-width: 1900px;
        padding: 20px;
    }

    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .form-label {
        font-size: 1.1rem;
        font-weight: 500;
    }

    .form-check-label {
        font-size: 1.1rem;
        color: #555;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 1.1rem;
        border-radius: 25px;
        padding: 12px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-block {
        width: 100%;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .row {
        margin-top: 20px;
    }

    .col-md-6 {
        margin-bottom: 10px;
    }

    .mt-3 {
        margin-top: 20px;
    }

    h2 {
        font-size: 2.5rem;
        font-weight: 600;
        color: #007bff;
    }

    table th, table td {
        text-align: center;
    }

    table th {
        background-color: #007bff;
        color: #fff;
    }

    .btn-sm {
        font-size: 0.9rem;
        padding: 5px 10px;
    }
</style>

@endsection
