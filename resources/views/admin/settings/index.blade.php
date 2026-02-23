@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>{{ request('group') ? ucfirst(request('group')) . ' Settings' : 'Website Settings' }}</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.settings.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Setting
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
                        <th width="50">No</th>
                        <th>Group</th>
                        <th>Label / Key</th>
                        <th>Value</th>
                        <th>Type</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($settings as $setting)
                    <tr>
                        <td>{{ $loop->iteration + ($settings->currentPage() - 1) * $settings->perPage() }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ ucfirst($setting->group) }}</span>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $setting->label }}</div>
                            <small class="text-muted"><code>{{ $setting->key }}</code></small>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 250px;">
                                @if($setting->type == 'file')
                                    <span class="text-muted small">[File Path: {{ $setting->value }}]</span>
                                @else
                                    {{ $setting->value ?? '-' }}
                                @endif
                            </div>
                        </td>
                        <td><small>{{ strtoupper($setting->type) }}</small></td>
                        <td>
                            <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center py-4 text-muted">No settings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $settings->links() }}
        </div>
    </div>
</div>
@endsection
