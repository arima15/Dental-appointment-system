@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dash/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dash/right-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dash/styles.css') }}">

@endsection

@section('content')
    <div class="main-content">
        <div class="clinic-dashboard">
            <section class="dashboard-section">
                <h2>Clinic Dashboard Overview</h2>
                <div class="dashboard">
                    <div class="card total-patients">
                        <h3>Total Bookings</h3>
                        <p>{{ App\Models\Booking::count() }}</p>
                        <button class="more-info-btn">
                            <a href="{{ route('pending') }}" class="nav-link">More info</a>
                        </button>
                    </div>
                    <div class="card services">
                        <h3>Services</h3>
                        <p>{{ App\Models\Service::count() }}</p>
                        <button class="more-info-btn">
                            <a href="{{ route('services.manage') }}" class="nav-link">More info</a>
                        </button>
                    </div>
                    <div class="card pending">
                        <h3>Pending Bookings</h3>
                        <p>{{ App\Models\Booking::where('status', 'pending')->count() }}</p>
                        <button class="more-info-btn">
                            <a href="{{ route('pending') }}" class="nav-link">More info</a>
                        </button>
                    </div>
                </div>
            </section>
        </div>

        <!-- Appointment Calendar -->
        <div class="calendar">
            <h3>Choose Date for Appointment</h3>
            <div class="calendar-header">
                <button>&lt;</button>
                <span>June 2023</span>
                <button>&gt;</button>
                <button>Today</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Sunday</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Calendar rows will be generated here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Legend and Holidays Section -->
    <div class="right-sidebar">
        <div class="legend-container">
            <h3>Legend</h3>
            <ul>
                <li><span class="legend available"></span> Available</li>
                <li><span class="legend no-slots"></span> No Slots</li>
                <li><span class="legend fully-booked"></span> Fully Booked</li>
                <li><span class="legend holiday"></span> Holiday</li>
            </ul>
        </div>

        <div class="holidays-container">
            <h3>Holidays for 2024</h3>
            <ul class="holiday-list">
                <li>2024-09-04: Labor Day</li>
                <li>2024-09-11: Patriot Day</li>
                <li>2024-09-25: Constitution Day</li>
                <li>2024-10-31: Halloween</li>
                <li>2024-11-01: All Saints' Day</li>
                <li>2024-11-02: All Souls' Day</li>
                <li>2024-11-30: Bonifacio Day</li>
                <li>2024-12-08: Feast of the Immaculate Conception</li>
                <li>2024-12-24: Christmas Eve</li>
                <li>2024-12-25: Christmas Day</li>
                <li>2024-12-30: Rizal Day</li>
                <li>2024-12-31: New Year's Eve</li>
            </ul>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->

@endsection

@section('scripts')
    <script src="{{ asset('js/dash/calendar.js') }}"></script>

@endsection
