@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Edit Product</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $product->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" 
                                name="category_id" 
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="usage" class="form-label">Usage / Application</label>
                        <textarea class="form-control @error('usage') is-invalid @enderror" 
                                  id="usage" 
                                  name="usage" 
                                  rows="3">{{ old('usage', $product->usage) }}</textarea>
                        <small class="text-muted">Explain how this product should be used (e.g., "Ideal for city cars").</small>
                        @error('usage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="features" class="form-label">Key Features</label>
                        <input type="text" 
                               class="form-control @error('features') is-invalid @enderror" 
                               id="features" 
                               name="features" 
                               value="{{ old('features', $product->features ? implode(', ', $product->features) : '') }}"
                               placeholder="Feature 1, Feature 2, Feature 3">
                        <small class="text-muted">Separate features with commas (e.g., "Durable, Light, OEM Quality").</small>
                        @error('features')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <div class="mb-2" id="preview-container">
                            @if($product->image)
                                <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="max-width: 100%; height: 150px; object-fit: cover;">
                            @else
                                <img id="image-preview" src="#" class="rounded shadow-sm" style="max-width: 100%; height: 150px; object-fit: cover; display: none;">
                            @endif
                        </div>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image"
                               accept="image/*"
                               onchange="previewImage(this)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB (JPEG, PNG, JPG, GIF)</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
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
@endsection
