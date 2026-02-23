@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Roles & Permissions</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-danger">
            <i class="bi bi-shield-plus"></i> Add New Role
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
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
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th width="100" class="text-center">Users</th>
                        <th width="150" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $role->name }} <br><small class="text-muted font-monospace">{{ $role->slug }}</small></td>
                            <td>
                                @foreach($role->permissions as $perm)
                                    <span class="badge bg-light text-dark border me-1 mb-1 small" style="font-weight: 400;">{{ $perm->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $role->users()->count() }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning" title="Edit Role">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($role->slug !== 'super-admin')
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this role?')"
                                                title="Delete Role">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No roles defined.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
