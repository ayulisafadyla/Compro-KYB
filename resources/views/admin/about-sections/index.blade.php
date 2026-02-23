@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Pusat Dukungan</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.about-sections.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Section
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
                        <th>Title</th>
                        <th width="100">Order</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aboutSections as $section)
                    <tr>
                        <td>{{ $loop->iteration + ($aboutSections->currentPage() - 1) * $aboutSections->perPage() }}</td>
                        <td>
                            <div class="fw-bold">{{ $section->title }}</div>
                        </td>
                        <td>{{ $section->order }}</td>
                        <td>
                            @if($section->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.about-sections.edit', $section) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.about-sections.destroy', $section) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center py-4 text-muted">No sections found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $aboutSections->links() }}
        </div>
    </div>
</div>
@endsection
