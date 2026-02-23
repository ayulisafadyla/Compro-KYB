@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>{{ isset($setting) ? 'Edit' : 'Add' }} Website Setting</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($setting) ? route('admin.settings.update', $setting) : route('admin.settings.store') }}" method="POST">
            @csrf
            @if(isset($setting))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="group" class="form-label">Group <span class="text-danger">*</span></label>
                    <input type="text" name="group" class="form-control @error('group') is-invalid @enderror" value="{{ old('group', $setting->group ?? 'general') }}" placeholder="e.g. general, seo, contact" required>
                    @error('group') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="text" {{ old('type', $setting->type ?? '') == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="textarea" {{ old('type', $setting->type ?? '') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                        <option value="number" {{ old('type', $setting->type ?? '') == 'number' ? 'selected' : '' }}>Number</option>
                        <option value="email" {{ old('type', $setting->type ?? '') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="url" {{ old('type', $setting->type ?? '') == 'url' ? 'selected' : '' }}>URL</option>
                        <option value="file" {{ old('type', $setting->type ?? '') == 'file' ? 'selected' : '' }}>File Path</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $setting->label ?? '') }}" placeholder="e.g. Site Name" required>
                    @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="key" class="form-label">Key <span class="text-danger">*</span></label>
                    <input type="text" name="key" class="form-control @error('key') is-invalid @enderror" value="{{ old('key', $setting->key ?? '') }}" placeholder="e.g. site_name" required>
                    @error('key') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Lowercase, underscore allowed (Unique).</small>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="value" class="form-label">Value</label>
                    @if(isset($setting) && $setting->type == 'textarea')
                        <textarea name="value" class="form-control @error('value') is-invalid @enderror" rows="5">{{ old('value', $setting->value ?? '') }}</textarea>
                    @else
                        <input type="text" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ old('value', $setting->value ?? '') }}">
                    @endif
                    @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Setting
                </button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
