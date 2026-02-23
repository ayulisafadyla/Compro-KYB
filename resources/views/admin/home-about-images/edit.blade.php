@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Company Images</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.home-about-images.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-lg-7">
                            <label class="form-label fw-bold mb-3">Image Preview</label>
                            <div id="preview-container" class="bg-light border rounded-3 text-center overflow-hidden" style="min-height: 400px; display: flex; align-items: center; justify-content: center; border-style: dashed !important; border-width: 2px !important;">
                                @if(isset($aboutImage) && $aboutImage->image)
                                    <img id="image-preview" src="{{ asset('storage/' . $aboutImage->image) }}" class="img-fluid" style="width: 100%; height: 400px; object-fit: contain;">
                                @else
                                    <div id="no-preview" class="text-muted p-5">
                                        <i class="bi bi-image display-1 d-block mb-3 opacity-25"></i>
                                        <p class="mb-0">No image uploaded yet</p>
                                    </div>
                                    <img id="image-preview" src="#" class="img-fluid d-none" style="width: 100%; height: 400px; object-fit: contain;">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5 d-flex flex-column justify-content-center">
                            <div class="p-3 border rounded-3 bg-white shadow-sm">
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-bold">Select New Image</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-upload"></i></span>
                                        <input type="file" 
                                               class="form-control @error('image') is-invalid @enderror" 
                                               id="image" 
                                               name="image" 
                                               accept="image/*"
                                               onchange="previewImage(this)">
                                    </div>
                                    @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    <div class="mt-2">
                                        <span class="badge bg-light text-dark border"><i class="bi bi-info-circle me-1"></i> Format: JPG, PNG, WEBP</span>
                                        <span class="badge bg-light text-dark border"><i class="bi bi-hdd me-1"></i> Max: 2MB</span>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        <i class="bi bi-check-circle me-2"></i> Update Image
                                    </button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle me-2"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#fff',
            iconColor: '#eb0a1e',
            customClass: {
                title: 'text-dark fw-bold',
                popup: 'rounded-4 border-0'
            }
        });
    @endif

    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const noPreview = document.getElementById('no-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (noPreview) {
                    noPreview.classList.add('d-none');
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
