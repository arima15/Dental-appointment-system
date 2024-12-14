@extends('layouts.app')

@section('title', 'User Profile - Clinic Appointment System')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="profile-card">
    <div class="profile-left">
        <img src="{{ $profile->profile_picture ? asset('storage/profile-pictures/' . $profile->profile_picture) : asset('profilepic.png') }}" 
             alt="Profile Picture" 
             id="profile-picture-left">
        <button class="edit-btn" data-field="photo">Edit Photo</button>
        <h4>{{ $profile->full_name }}</h4>
        <p>School ID: {{ $profile->school_id }}</p>
    </div>
    <div class="profile-right">
        <div class="profile-header">
            <h2>INFORMATION</h2>
        </div>
        <div class="profile-info">
                    <table>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td id="name">{{ $profile->full_name }}</td>
                            <td><button class="edit-btn" data-field="name">Edit</button></td>
                        </tr>
                        <tr>
                            <td><strong>Date of Birth:</strong></td>
                            <td id="dob">{{ $profile->date_of_birth ? $profile->date_of_birth->format('l jS \of F Y') : '' }}</td>
                            <td><button class="edit-btn" data-field="dob">Edit</button></td>
                        </tr>
                        <tr>
                            <td><strong>Age:</strong></td>
                            <td id="age">{{ $profile->age }}</td>
                            <td><button class="edit-btn" data-field="age">Edit</button></td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td id="address">{{ $profile->address }}</td>
                            <td><button class="edit-btn" data-field="address">Edit</button></td>
                        </tr>
                        <tr>
                            <td><strong>Gender:</strong></td>
                            <td id="gender">{{ $profile->gender }}</td>
                            <td><button class="edit-btn" data-field="gender">Edit</button></td>
                        </tr>
                        <tr>
                            <td><strong>Contact Number:</strong></td>
                            <td id="contact">{{ $profile->contact_number }}</td>
                            <td><button class="edit-btn" data-field="contact">Edit</button></td>
                        </tr>
                        <tr>
                            <td><strong>Username:</strong></td>
                            <td id="username">{{ $profile->username }}</td>
                            <td><button class="edit-btn" data-field="username">Edit</button></td>
                        </tr>
                    </table>
                </div>
        <div class="profile-footer">
            <button id="update-btn" class="update-btn">Update</button>
        </div>
    </div>
</div>

<!-- Update Profile Modal -->
<div id="update-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Update Profile</h2>
        <form id="update-form">
            <div class="form-group" id="text-field-group">
                <label for="update-field">Field:</label>
                <input type="text" id="update-field" name="field" readonly>
            </div>
            <div class="form-group" id="text-value-group">
                <label for="update-value">Value:</label>
                <input type="text" id="update-value" name="value" required>
            </div>
            <div class="form-group" id="photo-group" style="display: none;">
                <label for="update-photo">Upload Photo:</label>
                <input type="file" id="update-photo" name="photo" accept="image/*">
            </div>
            <button type="submit" class="submit-btn">Save Changes</button>
        </form>
    </div>
</div>

<!-- Logout Confirmation Modal -->
<div id="logout-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Are you sure you want to log out?</h2>
        <button id="confirm-logout" class="logbttn">Yes</button>
        <button id="cancel-logout" class="logbttn">No</button>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/partials/profile.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/profile.js') }}"></script>
@endsection