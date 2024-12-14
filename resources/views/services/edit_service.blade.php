@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
    <div class="main-content">
        <h2 class="page-title">Edit Service</h2>

        <div class="card p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form id="updateForm" action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Service Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $service->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price (₱)</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                        id="price" name="price" value="{{ old('price', $service->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3" required>{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group text-center">
                    <button type="button" class="btn btn-success" id="confirmUpdate">Update Service</button>
                    <a href="{{ route('services.manage') }}" class="btn btn-secondary">Cancel</a>
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
                    Are you sure you want to update this service?
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
    <style>
        .main-content {
            padding-top: 70px;
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
            margin: 0 auto;
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 20px;
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
            margin: 0 5px;
        }

        .btn-success {
            background-color: #48CFCB;
            border-color: #48CFCB;
        }

        .btn-success:hover {
            background-color: #3dbfbb;
            border-color: #3dbfbb;
        }

        .btn-secondary {
            background-color: #6A9C89;
            border-color: #6A9C89;
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background-color: #16423C;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .modal-footer {
            border-radius: 0 0 8px 8px;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.getElementById('confirmUpdate').addEventListener('click', function() {
            $('#confirmationModal').modal('show');
        });

        document.getElementById('confirmUpdateYes').addEventListener('click', function() {
            document.getElementById('updateForm').submit();
        });
    </script>
@endsection
