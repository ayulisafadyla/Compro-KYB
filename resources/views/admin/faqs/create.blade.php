@extends('admin.layouts.app')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

<div class="row mb-3">
    <div class="col-md-12">
        <h2>{{ isset($faq) ? 'Edit' : 'Add' }} FAQ</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" method="POST">
            @csrf
            @if(isset($faq))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question', $faq->question ?? '') }}" required>
                @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="editor" class="form-label">Answer <span class="text-danger">*</span></label>
                <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" rows="5" id="editor">{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Icon (Bootstrap Icons)</label>
                <div class="input-group">
                    <span class="input-group-text" id="icon-preview">
                        <i class="bi {{ old('icon', $faq->icon ?? 'bi-patch-question-fill') }}" id="icon-display"></i>
                    </span>
                    <input type="text" name="icon" id="icon-input" class="form-control"
                           value="{{ old('icon', $faq->icon ?? 'bi-patch-question-fill') }}"
                           placeholder="e.g. bi-trophy-fill, bi-shield-check, bi-shop">
                </div>
                <small class="text-muted">
                    Lihat daftar icon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap</a>.
                </small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $faq->order ?? 0) }}">
                </div>
                <div class="col-md-6 mb-3 d-flex align-items-center mt-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save FAQ
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
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

    // Icon live preview
    document.getElementById('icon-input').addEventListener('input', function() {
        var val = this.value.trim();
        if (!val.startsWith('bi-')) val = 'bi-' + val.replace(/^-+/, '');
        document.getElementById('icon-display').className = 'bi ' + val;
    });

    // Quick-pick buttons
    document.querySelectorAll('.icon-pick-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var icon = this.dataset.icon;
            document.getElementById('icon-input').value = icon;
            document.getElementById('icon-display').className = 'bi ' + icon;
        });
    });
</script>
@endpush
