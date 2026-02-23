@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Video Banners</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.home-videos.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Video
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
                        <th>No</th>
                        <th>Background</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Video URL</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($videos as $video)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($video->background_image)
                                <img src="{{ asset('storage/' . $video->background_image) }}" alt="" class="rounded" style="width: 80px; height: 45px; object-fit: cover;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $video->title ?? '-' }}</td>
                        <td>{{ $video->subtitle ?? '-' }}</td>
                        <td><a href="{{ $video->video_url }}" target="_blank" class="text-danger">{{ Str::limit($video->video_url, 40) }}</a></td>
                        <td>
                            @if($video->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.home-videos.edit', $video) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.home-videos.destroy', $video) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center text-muted">No Video Banners Found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
