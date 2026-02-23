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
        <h2>{{ isset($homeAbout) ? 'Edit' : 'Add' }} About Section</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($homeAbout) ? route('admin.home-abouts.update', $homeAbout) : route('admin.home-abouts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($homeAbout))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $homeAbout->title ?? '') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe Konten <span class="text-danger">*</span></label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="sejarah" {{ old('type', $homeAbout->type ?? '') == 'sejarah' ? 'selected' : '' }}>Sejarah Perusahaan (Kolom Kiri)</option>
                            <option value="visi-misi" {{ old('type', $homeAbout->type ?? '') == 'visi-misi' ? 'selected' : '' }}>Visi &amp; Misi (Kolom Kanan)</option>
                        </select>
                        <small class="text-muted">Pilih posisi konten di halaman Beranda.</small>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10" id="editor">{{ old('content', $homeAbout->content ?? '') }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="mb-3">
                        <label for="image" class="form-label">Section Image</label>
                        <div class="mb-2" id="preview-container">
                            @if(isset($homeAbout) && $homeAbout->image)
                                <img id="image-preview" src="{{ asset('storage/'.$homeAbout->image) }}" class="rounded shadow-sm" style="max-width: 100%; height: 200px; object-fit: cover;">
                            @else
                                <img id="image-preview" src="#" class="rounded shadow-sm" style="max-width: 100%; height: 200px; object-fit: cover; display: none;">
                            @endif
                        </div>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Max 2MB (JPEG, PNG, JPG).</small>
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $homeAbout->order ?? 0) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $homeAbout->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Section
                </button>
                <a href="{{ route('admin.home-abouts.index') }}" class="btn btn-secondary">
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
        height: 300,
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
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
