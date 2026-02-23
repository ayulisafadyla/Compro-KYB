@extends('admin.layouts.app')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

<div class="row mb-3">
    <div class="col-md-12">
        <h2>{{ isset($homePhilosophy) ? 'Edit' : 'Add' }} Philosophy Item</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($homePhilosophy) ? route('admin.home-philosophies.update', $homePhilosophy) : route('admin.home-philosophies.store') }}" method="POST">
            @csrf
            @if(isset($homePhilosophy))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $homePhilosophy->title ?? '') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5" id="editor">{{ old('content', $homePhilosophy->content ?? '') }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon Name</label>
                        <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $homePhilosophy->icon ?? '') }}" placeholder="e.g. award">
                        <small class="text-muted">Find Icons At <a href="https://icons.getbootstrap.com/" target="_blank" class="text-danger">Bootstrap</a></small>
                        @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $homePhilosophy->order ?? 0) }}">
                    </div>

                    <div class="mb-3">
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Item
                </button>
                <a href="{{ route('admin.home-philosophies.index') }}" class="btn btn-secondary">
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
        tabsize: 2,
        height: 200,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link']],
          ['view', ['fullscreen', 'codeview']]
        ]
    });
</script>
@endpush
