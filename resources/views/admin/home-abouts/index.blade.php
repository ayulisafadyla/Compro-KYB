@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>About Us</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.home-abouts.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Section
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
                        <th>Title</th>
                        <th>Tipe</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($abouts as $about)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $about->title }}</td>
                        <td>
                            @if($about->type == 'sejarah')
                                <span class="badge bg-info">Sejarah Perusahaan</span>
                            @elseif($about->type == 'visi-misi')
                                <span class="badge bg-warning text-dark">Visi &amp; Misi</span>
                            @else
                                <span class="badge bg-secondary">{{ $about->type }}</span>
                            @endif
                        </td>
                        <td>{{ $about->order }}</td>
                        <td>
                            @if($about->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.home-abouts.edit', $about) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.home-abouts.destroy', $about) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center text-muted">No about sections found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
