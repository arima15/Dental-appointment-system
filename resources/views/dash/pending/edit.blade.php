@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
    <div class="main-content">
        <h2 class="page-title">Edit Appointment</h2>

        <div class="card p-4">
            <form id="updateForm" action="{{ route('booking.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="service">Service</label>
                    <select name="service" id="service" class="form-control">
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                                {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" value="{{ $booking->date }}" class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="time" name="time" id="time" value="{{ $booking->time }}" class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="finished" {{ $booking->status == 'finished' ? 'selected' : '' }}>Finished</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group text-center">
                    <button type="button" class="btn btn-success" id="confirmUpdate">Update Appointment</button>
                    <a href="{{ route('pending') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Changes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update the appointment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmUpdateYes">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .main-content {
            padding-top: 70px;
            /* Adjusted for fixed header */
            z-index: -1;
        }

        .page-title {
            color: #16423C;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .card {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #48CFCB;
            color: white;
        }

        .btn-secondary {
            background-color: #6A9C89;
            color: white;
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #16423C;
            color: white;
        }

        .modal-footer .btn {
            font-size: 16px;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('confirmUpdate').addEventListener('click', function() {
            $('#confirmationModal').modal('show');
        });

        document.getElementById('confirmUpdateYes').addEventListener('click', function() {
            // Remove the form submission here and handle via AJAX
            $.ajax({
                url: "{{ route('booking.update', $booking->id) }}",
                method: 'POST',
                data: $('#updateForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = '{{ route('pending') }}';
                    }
                },
                error: function(xhr) {
                    alert('There was an error updating the appointment. Please try again.');
                }
            });
        });

        // Remove the form submit event listener that was causing conflicts
    </script>
@endsection
