@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Static Pages</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.pages.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add New Page
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
                        <th>Slug</th>
                        <th>Last Updated</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td>{{ $loop->iteration + ($pages->currentPage() - 1) * $pages->perPage() }}</td>
                        <td>
                            <div class="fw-bold">{{ $page->title }}</div>
                        </td>
                        <td><code>{{ $page->slug }}</code></td>
                        <td>{{ $page->updated_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline">
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
                        <td colspan="5" class="text-center py-4 text-muted">No pages found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pages->links() }}
        </div>
    </div>
</div>
@endsection
