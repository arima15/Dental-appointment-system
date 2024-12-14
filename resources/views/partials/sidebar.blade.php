<div class="sidebar">
    <nav id="navbar">
        <span class="close">&times;</span>
        <div class="profile">
            <img src="{{ asset('profilepic.png') }}" alt="Profile Picture" class="profile-picture">
            <div class="profile-text">
                <h4>{{ auth()->user()->profile->full_name ?? 'User Name' }}</h4>
                <p><a href="{{ route('profile.show') }}">Visit profile</a></p>
            </div>
        </div>
        <hr>
        <ul>
            <li><a href="{{ url('dashboard') }}" id="programMenu">Dashboard</a></li>
            <li><a href="{{ url('services/manage') }}">Services</a></li>
            <li><a href="{{ url('pending') }}" id="studentMenu">Appointment</a></li>
            <li><a href="#" class="logout">Log out</a></li>
        </ul>
    </nav>
    <div class="contact-info">
        <h3>Contact Us</h3>
        <p><i class="bx bx-phone"></i> +1 (123) 456-7890</p>
        <p><i class="bx bx-envelope"></i> support@clinic.com</p>
        <p><i class="bx bx-map"></i> 123 Clinic St, Mandaue City, Cebu</p>
    </div>
</div>

<div id="logout-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Are you sure you want to log out?</h2>
        <button id="confirm-logout" class="logbttn">Yes</button>
        <button id="cancel-logout" class="logbttn">No</button>
    </div>
</div>

<script>
    const homeUrl = "{{ route('home') }}";
</script>
