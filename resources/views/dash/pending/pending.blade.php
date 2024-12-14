@extends('layouts.app')

@section('title', 'Pending Appointments')

@section('content')
<div class="main-content">
    <h2 class="page-title">Pending Appointments</h2>

    <!-- Filter Section -->
    <div class="filter-section">
        <label for="status-filter" class="filter-label">Filter by Status: </label>
        <select id="status-filter" class="filter-select">
            <option value="all">All</option>
            <option value="pending">Pending</option>
            <option value="finished">Finished</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    @if($bookings->isEmpty())
        <p class="no-appointments-msg">No appointments found.</p>
    @else
        <div class="table-container">
            <table class="appointments-table" id="appointments-table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Transaction No.</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr class="appointment-row" data-status="{{ $booking->status }}">
                        <td>
                            <a href="{{ route('booking.show', $booking->id) }}" class="action-btn view-btn">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('booking.edit', $booking->id) }}" class="action-btn edit-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="action-btn cancel-btn" data-id="{{ $booking->id }}">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </td>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->service }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="status-icon pending">
                                    <i class="fas fa-hourglass-half"></i> Pending
                                </span>
                            @elseif($booking->status == 'finished')
                                <span class="status-icon finished">
                                    <i class="fas fa-check-circle"></i> Finished
                                </span>
                            @elseif($booking->status == 'cancelled')
                                <span class="status-icon cancelled">
                                    <i class="fas fa-times-circle"></i> Cancelled
                                </span>
                            @else
                                <span class="status-icon unknown">
                                    <i class="fas fa-question-circle"></i> Unknown
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/partials/pending.css') }}">
<style>
    .main-content {
        padding-top: 70px;
    }

    .page-title {
        color: #16423C;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .filter-section {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .filter-label {
        font-size: 16px;
        margin-right: 10px;
    }

    .filter-select {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f5f5f5;
    }

    .filter-select:focus {
        outline: none;
        border-color: #229799;
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .appointments-table {
        width: 100%;
        border-collapse: collapse;
    }

    .appointments-table th, .appointments-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .appointments-table th {
        background-color: #229799;
        color: white;
    }

    .action-btn {
        padding: 5px 10px;
        margin: 5px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: white;
        border-radius: 5px;
    }

    .view-btn {
        background-color: #48CFCB;
    }

    .edit-btn {
        background-color: #6A9C89;
    }

    .cancel-btn {
        background-color: #e74c3c;
    }

    .status-icon {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .status-icon i {
        font-size: 16px;
    }

    .pending {
        color: #f39c12;
    }

    .finished {
        color: #2ecc71;
    }

    .cancelled {
        color: #e74c3c;
    }

    .unknown {
        color: #95a5a6;
    }

    @media screen and (max-width: 768px) {
        .appointments-table th, .appointments-table td {
            font-size: 14px;
            padding: 8px;
        }
    }
</style>
@endsection

@section('scripts')

<script>
    // Filter functionality for status
    document.getElementById('status-filter').addEventListener('change', function() {
        let selectedStatus = this.value;
        let rows = document.querySelectorAll('.appointment-row');

        rows.forEach(row => {
            let status = row.getAttribute('data-status');
            if (selectedStatus == 'all' || selectedStatus == status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Cancel button functionality
    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to cancel this booking?')) {
                fetch(`/booking/${bookingId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to cancel the booking.');
                    }
                });
            }
        });
    });
</script>
@endsection


// In your controller for the pending page, fetch the bookings
public function showPending()
{
    $bookings = Booking::all();
    return view('dash.pending', compact('bookings'));
}