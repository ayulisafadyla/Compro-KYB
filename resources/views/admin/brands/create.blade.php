@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Add Brand</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" 
                               class="form-control @error('order') is-invalid @enderror" 
                               id="order" 
                               name="order" 
                               value="{{ old('order', 0) }}"
                               min="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3 text-center">
                        <label for="logo" class="form-label d-block text-start">Brand Logo <span class="text-danger">*</span></label>
                        <div class="bg-light border rounded p-3 mb-3 d-flex align-items-center justify-content-center" style="height: 156px;">
                            <img id="logo-preview" 
                                 src="#" 
                                 alt="Preview" 
                                 class="img-fluid d-none" 
                                 style="max-height: 100%;">
                            <div id="no-logo-preview" class="text-muted">
                                <i class="bi bi-image display-4 d-block mb-2"></i>
                                <span>Preview Logo</span>
                            </div>
                        </div>
                        <input type="file" 
                               class="form-control @error('logo') is-invalid @enderror" 
                               id="logo" 
                               name="logo"
                               accept="image/*"
                               required
                               onchange="previewImage(this)">
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1 text-start">Recommended: 140x90px. Max 2MB.</small>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Brand
                </button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('logo-preview');
        const noPreview = document.getElementById('no-logo-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                noPreview.classList.add('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
