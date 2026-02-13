@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>{{ $category ? 'Edit' : 'Add' }} Category</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if($category)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $category->name ?? '') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          name="description" 
                          rows="3">{{ old('description', $category->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Optional - Brief description of this category.</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> {{ $category ? 'Update' : 'Save' }}
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
