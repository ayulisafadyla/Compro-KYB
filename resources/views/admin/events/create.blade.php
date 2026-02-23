@extends('admin.layouts.app')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-editor.note-frame { border: 1px solid #dee2e6; border-radius: 0.375rem; }
    .note-toolbar { background: #f8f9fa; border-bottom: 1px solid #dee2e6; }
</style>
@endpush

<div class="row mb-3">
    <div class="col-md-12">
        <h2>Add {{ $type ? ucfirst($type === 'launch' ? 'Event' : str_replace('_', ' ', $type)) : 'New Event' }}</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($event))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title ?? '') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Short Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $event->description ?? '') }}</textarea>
                        <small class="text-muted">Brief summary for the event list.</small>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Detailed Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10" id="editor">{{ old('content', $event->content ?? '') }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="type" class="form-label">Event Type <span class="text-danger">*</span></label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">Select Type</option>
                            <option value="launch" {{ old('type', $type) == 'launch' ? 'selected' : '' }}>Events</option>
                            <option value="workshop" {{ old('type', $type) == 'workshop' ? 'selected' : '' }}>Penghargaan</option>
                            <option value="promo" {{ old('type', $type) == 'promo' ? 'selected' : '' }}>Sertifikat</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Event Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', isset($event->date) ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '') }}" required>
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Images</label>
                        <div class="mb-2" id="preview-container" style="{{ isset($event) && $event->image ? '' : 'display: none;' }}">
                            <img id="image-preview" src="{{ isset($event) && $event->image ? asset('storage/'.$event->image) : '#' }}" class="rounded shadow-sm" style="max-width: 100%; height: 200px; object-fit: cover;">
                        </div>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Max 2MB (JPEG, PNG, JPG). Higher resolution recommended.</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_published" class="form-check-input" id="isPublished" value="1" {{ old('is_published', $event->is_published ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isPublished">Published</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Event
                </button>
                <a href="{{ route('admin.events.index', ['type' => $event->type ?? request('type')]) }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $('#editor').summernote({
        placeholder: 'Enter detailed event content...',
        tabsize: 2,
        height: 350,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture']],
          ['view', ['fullscreen', 'codeview']]
        ]
    });

    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('preview-container');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
