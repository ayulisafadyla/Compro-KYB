@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>{{ isset($contactItem) ? 'Edit' : 'Add' }} Contact Item</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ isset($contactItem) ? route('admin.contact-items.update', $contactItem) : route('admin.contact-items.store') }}" method="POST">
            @csrf
            @if(isset($contactItem))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $contactItem->label ?? '') }}" placeholder="e.g. Hubungi Kami" required>
                    @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                    <input type="text" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ old('value', $contactItem->value ?? '') }}" placeholder="e.g. +62 21 8981456" required>
                    @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi {{ old('icon', $contactItem->icon ?? 'bi-info-circle-fill') }}" id="icon-display"></i>
                        </span>
                        <input type="text" name="icon" id="icon-input" class="form-control @error('icon') is-invalid @enderror"
                               value="{{ old('icon', $contactItem->icon ?? 'bi-info-circle-fill') }}"
                               placeholder="e.g. bi-telephone-fill, bi-envelope-fill, bi-geo-alt-fill">
                    </div>
                    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Lihat <a href="https://icons.getbootstrap.com/" target="_blank">Icons</a>.</small>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $contactItem->order ?? 0) }}">
                </div>

                <div class="col-md-3 mb-3 d-flex align-items-center mt-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $contactItem->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Save Contact
                </button>
                <a href="{{ route('admin.contact-items.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Icon live preview
    document.getElementById('icon-input').addEventListener('input', function() {
        var val = this.value.trim();
        if (!val.startsWith('bi-')) val = 'bi-' + val.replace(/^-+/, '');
        document.getElementById('icon-display').className = 'bi ' + val;
    });
    // Quick-pick buttons
    document.querySelectorAll('.icon-pick-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var icon = this.dataset.icon;
            document.getElementById('icon-input').value = icon;
            document.getElementById('icon-display').className = 'bi ' + icon;
        });
    });
</script>
@endpush
