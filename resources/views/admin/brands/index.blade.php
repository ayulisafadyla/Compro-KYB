@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Brand Logo</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Brand
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Order</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brands as $brand)
                    <tr>
                        <td>{{ $loop->iteration + ($brands->currentPage() - 1) * $brands->perPage() }}</td>
                        <td>
                            @if($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}"
                                     alt="{{ $brand->name }}"
                                     class="rounded"
                                     style="width: 80px; height: 40px; object-fit: contain; background: #f8f9fa; padding: 2px; border: 1px solid #eee;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 40px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $brand->name }}</td>
                        <td><span class="badge bg-secondary">{{ $brand->order }}</span></td>
                        <td>
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No brands found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $brands->links() }}
        </div>
    </div>
</div>
@endsection
