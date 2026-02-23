@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Product Detail</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid rounded mb-3">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                         style="height: 300px;">
                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                    </div>
                @endif
                
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Product
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3>{{ $product->name }}</h3>
                <p class="text-muted mb-3">
                    <span class="badge bg-secondary">{{ $product->category->name }}</span>
                    @if($product->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>

                <table class="table table-borderless">
                    <tr>
                        <th>Slug:</th>
                        <td><code>{{ $product->slug }}</code></td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $product->updated_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>

                <hr>

                <h5>Description</h5>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
