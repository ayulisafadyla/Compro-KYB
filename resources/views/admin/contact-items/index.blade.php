@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Kontak Kami</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.contact-items.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Contact Item
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
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Icon</th>
                        <th>Label</th>
                        <th>Value</th>
                        <th width="100">Order</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contactItems as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($contactItems->currentPage() - 1) * $contactItems->perPage() }}</td>
                        <td>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: #E62727;">
                                <i class="bi bi-{{ $item->icon ?? 'info-circle' }}"></i>
                            </div>
                        </td>
                        <td><div class="fw-bold">{{ $item->label }}</div></td>
                        <td>{{ $item->value }}</td>
                        <td>{{ $item->order }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.contact-items.edit', $item) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.contact-items.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No contact items found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $contactItems->links() }}
        </div>
    </div>
</div>
@endsection
