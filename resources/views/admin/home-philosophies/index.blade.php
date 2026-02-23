@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Philosophy</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.home-philosophies.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Item
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
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Order</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($philosophies as $phil)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><i class="bi bi-{{ $phil->icon }} text-danger" style="font-size: 1.5rem;"></i></td>
                        <td>{{ $phil->title }}</td>
                        <td>{{ $phil->order }}</td>
                        <td>
                            <a href="{{ route('admin.home-philosophies.edit', $phil) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.home-philosophies.destroy', $phil) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No Philosophy Items Found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
