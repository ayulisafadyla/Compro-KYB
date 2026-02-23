@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>{{ isset($homeVideo) ? 'Edit' : 'Add' }} Video Banner</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($homeVideo) ? route('admin.home-videos.update', $homeVideo) : route('admin.home-videos.store') }}" method="POST">
            @csrf
            @if(isset($homeVideo))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $homeVideo->title ?? '') }}">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Slogan</label>
                        <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $homeVideo->subtitle ?? '') }}">
                        @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="video_url" class="form-label">YT Video URL <span class="text-danger">*</span></label>
                        <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $homeVideo->video_url ?? '') }}" required placeholder="https://www.youtube.com/watch?v=...">
                        @error('video_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $homeVideo->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">Set as Active Banner (Deactivates others)</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Video Banner
                </button>
                <a href="{{ route('admin.home-videos.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
