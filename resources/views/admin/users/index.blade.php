@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Admin Users</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.users.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add New User
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Last Updated</th>
                        <th width="150" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td class="fw-bold">{{ $user->name }}</td>
                            <td><span class="badge bg-light text-dark"> {{ $user->username }}</span></td>
                            <td>
                                @if($user->role)
                                    <span class="badge bg-info">{{ $user->role->name }}</span>
                                @else
                                    <span class="text-muted small">No Role</span>
                                @endif
                            </td>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit User">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this user?')"
                                                title="Delete User">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No Users Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
