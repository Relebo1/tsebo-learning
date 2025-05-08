@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-header text-white" style="background-color: #007bff;">
            <h4 class="text-center"><i class="bi bi-lock"></i> Login</h4>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf

                <!-- Email Input with Icon -->
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <!-- Password Input with Icon -->
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>

                <!-- Remember Me with Icon -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember"><i class="bi bi-check-square"></i> Remember me</label>
                </div>

                <!-- Submit Button with Icon -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                </div>

                <!-- Forgot Password Link with Icon -->
                <div class="text-center mt-3">
                    <a href="#" class="text-muted"><i class="bi bi-question-circle"></i> Forgot your password?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
