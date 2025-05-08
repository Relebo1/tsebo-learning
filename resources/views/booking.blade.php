@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="font-size: 28px; color: #007bff;">Book a Tutor</h2>

    <form action="{{ route('book.tutor.store') }}" method="POST">
        @csrf
        <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">

        <!-- Tutor Name -->
        <div class="mb-3">
            <label for="tutor-name" class="form-label">Tutor Name</label>
            <input type="text" class="form-control" id="tutor-name" value="{{ $instructor->fullname }}" readonly>
        </div>

        <!-- Subject -->
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" value="{{ $instructor->subject }}" readonly>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" value="R{{ number_format($instructor->fee, 2) }}" readonly>
        </div>

        <!-- Booking Date -->
        <div class="mb-3">
            <label for="booking-date" class="form-label">Booking Date</label>
            <input type="date" class="form-control" name="booking_date" id="booking-date" required>
        </div>

        <!-- Booking Time -->
        <div class="mb-3">
            <label for="booking-time" class="form-label">Booking Time</label>
            <input type="time" class="form-control" name="booking_time" id="booking-time" required>
        </div>

        <!-- Payment Method Selection -->
        <div class="mb-3">
            <label for="payment-method" class="form-label">Payment Method</label>
            <select name="payment_method" id="payment-method" class="form-control" required>
                <option value="mpesa">MPesa</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>

        <!-- Conditional Payment Info (for MPesa and PayPal) -->
        <div class="mb-3" id="mpesa-info" style="display:none;">
            <label for="mpesa-number" class="form-label">MPesa Number</label>
            <input type="text" class="form-control" name="mpesa_number" id="mpesa-number" placeholder="Enter your MPesa number">
        </div>

        <div class="mb-3" id="paypal-info" style="display:none;">
            <label for="paypal-email" class="form-label">PayPal Email</label>
            <input type="email" class="form-control" name="paypal_email" id="paypal-email" placeholder="Enter your PayPal email">
        </div>

        <button type="submit" class="btn btn-primary">Confirm Booking</button>
    </form>
</div>

<script>
    // Toggle payment method info based on selection
    document.getElementById('payment-method').addEventListener('change', function() {
        var paymentMethod = this.value;
        if (paymentMethod === 'mpesa') {
            document.getElementById('mpesa-info').style.display = 'block';
            document.getElementById('paypal-info').style.display = 'none';
        } else if (paymentMethod === 'paypal') {
            document.getElementById('mpesa-info').style.display = 'none';
            document.getElementById('paypal-info').style.display = 'block';
        }
    });
</script>

@endsection
