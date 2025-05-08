@extends('layouts.app')

@section('content')
<div>
    <h2>Student Registration</h2>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <p>{{ implode(', ', $errors->all()) }}</p>
    @endif
    <form action="{{ route('student.register.form') }}" method="POST">
        @csrf
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
</div>
@endsection
