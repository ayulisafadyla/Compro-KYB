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
        <h2>{{ isset($page) ? 'Edit' : 'Add' }} Static Page</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($page) ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}" method="POST">
            @csrf
            @if(isset($page))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $page->title ?? '') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Page Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="15" id="editor">{{ old('content', $page->content ?? '') }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body">
                            <h5 class="card-title">SEO Metadata</h5>
                            <hr>
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $page->meta_title ?? '') }}">
                                @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="4">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                                @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    @if(isset($page))
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <h5 class="card-title">Page Info</h5>
                            <hr>
                            <p class="mb-1 small text-muted"><strong>Slug:</strong> <code>{{ $page->slug }}</code></p>
                            <p class="mb-1 small text-muted"><strong>Created:</strong> {{ $page->created_at->format('d M Y') }}</p>
                            <p class="mb-0 small text-muted"><strong>Updated:</strong> {{ $page->updated_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Page
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
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
        placeholder: 'Enter page content...',
        tabsize: 2,
        height: 500,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>
@endpush
