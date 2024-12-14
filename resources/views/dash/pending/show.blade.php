@extends('layouts.app')

@section('title', 'Appointment Details')

@section('content')
<div class="main-content">
    <h2 class="page-title">Appointment Details</h2>

    <div class="card p-4">
        <div class="appointment-info">
            <div class="row mb-3">
                <div class="col-md-4"><strong>Transaction No:</strong></div>
                <div class="col-md-8">{{ $booking->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Service:</strong></div>
                <div class="col-md-8">{{ $booking->service }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Date:</strong></div>
                <div class="col-md-8">{{ $booking->date }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Status:</strong></div>
                <div class="col-md-8">
                    <span class="status-icon {{ $booking->status == 'approved' ? 'finished' : ($booking->status == 'pending' ? 'pending' : 'cancelled') }}">
                        <i class="fas {{ $booking->status == 'approved' ? 'fa-check-circle' : ($booking->status == 'pending' ? 'fa-hourglass-half' : 'fa-times-circle') }}"></i>
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Name:</strong></div>
                <div class="col-md-8">{{ $booking->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Email:</strong></div>
                <div class="col-md-8">{{ $booking->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Phone Number:</strong></div>
                <div class="col-md-8">{{ $booking->phone }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Address:</strong></div>
                <div class="col-md-8">{{ $booking->address }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Time:</strong></div>
                <div class="col-md-8">{{ $booking->time }}</div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('pending') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Appointments
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
@parent
<style>
    .main-content {
        padding-top: 70px; /* Adjusted for fixed header */
        z-index: -1;
    }

    .page-title {
        color: #16423C;
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .card {
        background-color: #E9EFEC;
        border: 1px solid #C4DAD2;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .appointment-info {
        font-size: 16px;
    }

    .row div {
        padding: 5px 0;
    }

    .status-icon {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .status-icon i {
        font-size: 18px;
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

    .btn-primary {
        background-color: #229799;
        border: none;
    }

    .btn-primary:hover {
        background-color: #16423C;
    }

    .btn-secondary {
        background-color: #424242;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #6a6a6a;
    }

    @media screen and (max-width: 768px) {
        .card {
            padding: 15px;
        }

        .appointment-info {
            font-size: 14px;
        }
    }
</style>
@endsection
