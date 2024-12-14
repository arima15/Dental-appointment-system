@extends('layouts.app')

@section('title', 'Manage Dentists')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dentists/manage.css') }}">
@endsection

@section('content')
<div class="main-content">
    <h2>Manage Dentists</h2>

    <!-- Dentists Table -->
    <table class="dentists-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Specialization</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dentists as $dentist)
            <tr>
                <td>{{ $dentist->name }}</td>
                <td>{{ $dentist->specialization }}</td>
                <td>{{ $dentist->email }}</td>
                <td>{{ $dentist->phone }}</td>
                <td>{{ $dentist->availability ? 'Available' : 'Unavailable' }}</td>
                <td>
                    <a href="{{ route('dentists.edit', $dentist->id) }}" class="edit-btn">Edit</a>
                    <form action="{{ route('dentists.destroy', $dentist->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Add New Dentist</h3>
    <form action="{{ route('dentists.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="specialization">Specialization:</label>
        <input type="text" id="specialization" name="specialization" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone">

        <label for="availability">Availability:</label>
        <select id="availability" name="availability">
            <option value="1">Available</option>
            <option value="0">Unavailable</option>
        </select>

        <button type="submit" class="submit-btn">Add Dentist</button>
    </form>

    <h2>Manage Payments</h2>
    <table class="payments-table">
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->appointment_id }}</td>
                <td>${{ number_format($payment->amount, 2) }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->status }}</td>
                <td>
                    <a href="{{ route('payments.edit', $payment->id) }}" class="edit-btn">Edit</a>
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/dentists/manage.js') }}"></script>
@endsection 