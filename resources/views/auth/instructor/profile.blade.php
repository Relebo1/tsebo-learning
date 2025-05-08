@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="text-center mb-4" style="font-size: 28px; color: #007bff;">
        <i class="fas fa-user-edit"></i> Edit Profile
    </h2>

    <form action="{{ route('instructor.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- To specify the update request method -->

        <!-- Full Name -->
        <div class="form-group mb-4">
            <label for="fullname" class="font-weight-bold">Full Name</label>
            <input type="text" name="fullname" class="form-control" 
                   value="{{ old('fullname', optional(Auth::guard('instructor')->user())->fullname ?? '') }}">
        </div>

        <!-- Subject -->
        <div class="form-group mb-4">
            <label for="subject" class="font-weight-bold">Subject</label>
            <input type="text" name="subject" class="form-control" 
                   value="{{ old('subject', optional(Auth::guard('instructor')->user())->subject ?? '') }}">
        </div>

        <!-- Certifications -->
        <div class="form-group mb-4">
            <label for="certifications" class="font-weight-bold">Certifications</label>
            <textarea name="certifications" class="form-control" rows="4">
                {{ old('certifications', optional(Auth::guard('instructor')->user())->certifications ?? '') }}
            </textarea>
        </div>

        <!-- Certificate Uploads -->
        <div class="form-group mb-4">
            <label for="certificate_uploads" class="font-weight-bold">Certificate Uploads (PDF/JPG)</label>
            <input type="file" name="certificate_uploads" class="form-control-file">
        </div>

        <!-- Fee -->
        <div class="form-group mb-4">
            <label for="fee" class="font-weight-bold">Fee</label>
            <input type="number" step="0.01" name="fee" class="form-control" 
                   value="{{ old('fee', optional(Auth::guard('instructor')->user())->fee ?? '') }}">
        </div>

        <!-- Location -->
        <div class="form-group mb-4">
            <label for="location" class="font-weight-bold">Location</label>
            <input type="text" name="location" class="form-control" 
                   value="{{ old('location', optional(Auth::guard('instructor')->user())->location ?? '') }}">
        </div>

        <!-- Bio -->
        <div class="form-group mb-4">
            <label for="bio" class="font-weight-bold">Bio</label>
            <textarea name="bio" class="form-control" rows="4">
                {{ old('bio', optional(Auth::guard('instructor')->user())->bio ?? '') }}
            </textarea>
        </div>

        <!-- Profile Image -->
        <div class="form-group mb-4">
            <label for="image" class="font-weight-bold">Profile Image</label>
            <input type="file" name="image" class="form-control-file">
            @if(optional(Auth::guard('instructor')->user())->image)
                <div class="mt-3">
                    <img src="{{ asset('storage/profile_images/' . Auth::guard('instructor')->user()->image) }}" 
                         class="img-fluid rounded-circle" width="150" alt="Profile Image">
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="form-group mb-4">
            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="fas fa-save"></i> Update Profile
            </button>
        </div>
    </form>
</div>
@endsection
