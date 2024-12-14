<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentist Appointment</title>
    <link rel="stylesheet" href="{{ asset('css/sched.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newappfront.css') }}">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/main.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Login</h1>
            <form id="login-form" onsubmit="return validateLogin(event)">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <button type="button" id="toggle-password" class="toggle-password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <button type="submit" class="logbttn">Login</button>
            </form>
            <a href="#" class="foRGOT"><p>Forgot your password?</p></a>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="navbar">
    <img src="{{ asset('images/logo.webp') }}" class="logo" alt="Clinic Logo"
    style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;">
        <h3>Clinic System</h3>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Service</a></li>
            <li><a href="#">Contact</a></li>
            <button id="login-btn" class="bTTn">Login</button>
        </ul>
    </div>

    <!-- Dentist Booking Section -->
    <section>
        <div class="container">
            <!-- Step 1: Select a Date -->
            <div class="calendar-container step" id="step-1">
                <h2>Select a Date</h2>
                <div class="calendar-header">
                    <button class="prev-month">&#8249;</button>
                    <span class="month-year"></span>
                    <button class="next-month">&#8250;</button>
                </div>
                <table class="calendar">
                    <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body"></tbody>
                </table>
                <button id="next-to-time" class="next-btn" disabled>Next</button>
            </div>

            <!-- Step 2: Select a Time -->
            <div class="availability-container step" id="step-2" style="display:none;">
                <h3>Select a Time Slot</h3>
                <select id="time-slots">
                    <!-- Options will be populated dynamically -->
                </select>
                <div class="button-group">
                    <button id="back-to-date" class="back-btn">Back</button>
                    <button id="next-to-service" class="next-btn" disabled>Next</button>
                </div>
            </div>

            <!-- Step 3: Select a Service -->
            <div class="service-details step" id="step-3" style="display:none;">
                <h3>Service Details</h3>
                <label for="service-select">Choose a service:</label>
                <div class="service-options" id="service-select">
                    @foreach($services as $service)
                        <div class="service-option" 
                             data-value="{{ $service->id }}" 
                             data-description="{{ $service->name }} - ${{ number_format($service->price, 2) }}">
                            {{ $service->name }}
                        </div>
                    @endforeach
                </div>
                <div id="service-description">
                    Select a service to see details.
                </div>
                <div class="button-group">
                    <button id="back-to-time" class="back-btn">Back</button>
                    <button id="confirm-btn" class="next-btn" disabled>Confirm</button>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/login.js') }}"></script>
    <script src="{{ asset('js/newappfrontt.js') }}"></script>
</body>
</html>