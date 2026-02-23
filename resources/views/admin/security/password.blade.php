@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Change Password</h2>
        <p class="text-muted small">Update your account password to maintain security.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.security.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr class="my-4">

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-key-fill"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card shadow-sm border-0 bg-light">
            <div class="card-body">
                <h5>Password Requirements</h5>
                <ul class="text-muted small">
                    <li>Minimum 8 characters long</li>
                    <li>Should include letters, numbers and special characters</li>
                    <li>Must be different from your current password</li>
                    <li>Avoid using common words or personal information</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
