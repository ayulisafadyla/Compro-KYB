@extends('admin.layouts.app')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

<div class="row mb-3">
    <div class="col-md-12">
        <h2>{{ isset($policySection) ? 'Edit' : 'Add' }} Policy Section</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($policySection) ? route('admin.policy-sections.update', $policySection) : route('admin.policy-sections.store') }}" method="POST">
            @csrf
            @if(isset($policySection))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $policySection->title ?? '') }}" placeholder="e.g. Kebijakan Privasi" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="editor" class="form-label">Content <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10" id="editor">{{ old('content', $policySection->content ?? '') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $policySection->order ?? 0) }}">
                </div>
                <div class="col-md-6 mb-3 d-flex align-items-center mt-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $policySection->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Policy
                </button>
                <a href="{{ route('admin.policy-sections.index') }}" class="btn btn-secondary">
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
        placeholder: 'Enter policy content...',
        tabsize: 2,
        height: 350,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview']]
        ]
    });
</script>
@endpush
