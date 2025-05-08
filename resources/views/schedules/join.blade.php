@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4 text-primary">Join Class: {{ $schedule->subject }}</h2>
            <div class="card shadow-lg p-4 rounded">
                <!-- Container for Jitsi -->
                <div id="jitsi-container" style="width: 100%; height: 500px;">
                    <!-- The Jitsi video conference will be embedded here -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://meet.jit.si/external_api.js"></script>
<script>
    // Jitsi Meet API configuration
    var roomName = '{{ $roomName }}'; // From the route parameter

    var domain = "meet.jit.si";
    var options = {
        roomName: roomName,
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#jitsi-container'), // The container for the iframe
        configOverwrite: {
            startWithAudioMuted: true, // Mute audio on start
            startWithVideoMuted: true, // Mute video on start
        },
        interfaceConfigOverwrite: {
            TOOLBAR_BUTTONS: ['microphone', 'camera', 'desktop', 'hangup']
        },
        userInfo: {
            displayName: "{{ auth()->user()->name ?? 'Instructor' }}",  // Optionally use authenticated user name
        }
    };

    // Initialize the Jitsi Meet API
    const api = new JitsiMeetExternalAPI(domain, options);
</script>
@endpush
@endsection
