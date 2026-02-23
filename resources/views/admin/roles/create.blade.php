@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Create Security Role</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="e.g. Editor Konten">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug (System ID)</label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required placeholder="e.g. content-editor">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <h5 class="mb-3 border-bottom pb-2">Permissions</h5>
                    <div class="row g-3">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <div class="form-check border rounded p-2 px-3 hover-shadow-sm bg-light">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}" {{ is_array(old('permissions')) && in_array($permission->id, old('permissions')) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                        <div class="text-muted x-small font-monospace">{{ $permission->slug }}</div>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions') <div class="text-danger small mt-2">{{ $message }}</div> @enderror

                    <div class="mt-5 pt-3 border-top">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-save"></i> Save Role
                        </button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
