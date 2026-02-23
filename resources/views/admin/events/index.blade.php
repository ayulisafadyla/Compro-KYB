@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>{{ $title }}</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.events.create', ['type' => $type]) }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add New Event
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
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td>{{ $loop->iteration + ($events->currentPage() - 1) * $events->perPage() }}</td>
                        <td>
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-calendar-event text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold">{{ $event->title }}</div>
                            <small class="text-muted">{{ Str::limit($event->description, 50) }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($event->type) }}</span>
                        </td>
                        <td>
                            @if($event->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-warning">Draft</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline">
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
                        <td colspan="7" class="text-center py-4 text-muted">No events found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $events->appends(['type' => $type])->links() }}
        </div>
    </div>
</div>
@endsection
