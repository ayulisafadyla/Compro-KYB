@extends('layouts.app')
@section('title', 'Sertifikat & Pencapaian - KYB Indonesia')
@section('content')

<style>
    main {
        margin-top: 0 !important;
    }

    .tracking-wider {
        letter-spacing: 2px;
    }

    .stat-icon i {
        transition: transform 0.3s ease;
    }

    .stat-icon:hover i {
        transform: scale(1.2) rotate(10deg);
    }

    .btn-light:hover {
        background: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }

    .cert-card {
        cursor: pointer;
    }

    .cert-img {
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .default-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        transition: opacity 0.3s ease;
        z-index: 10;
    }

    .hover-overlay {
        background: rgba(235, 10, 30, 0.95);
        height: 50% !important;
        top: auto !important;
        bottom: 0;
        transform: translateY(100%);
        transition: transform 0.8s cubic-bezier(0.19, 1, 0.22, 1);
        z-index: 20;
    }

    .cert-card:hover .cert-img {
        transform: scale(1.1);
    }

    .cert-card:hover .hover-overlay {
        transform: translateY(0);
    }

    .cert-card:hover .default-overlay {
        opacity: 0;
    }

    /* Scroll Animations */
    .animate-on-scroll {
        opacity: 0;
        transition: opacity 1s ease-out, transform 1s ease-out;
        will-change: opacity, transform;
    }

    .animate-on-scroll.fade-up {
        transform: translateY(30px);
    }

    .animate-on-scroll.fade-down {
        transform: translateY(-30px);
    }

    .animate-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .delay-100 { transition-delay: 0.1s; }
    .delay-200 { transition-delay: 0.2s; }
    .delay-300 { transition-delay: 0.3s; }

    /* Zoom Button Styles */
    .zoom-btn-left {
        position: absolute;
        top: 50%;
        left: 20px; /* Position on the left */
        transform: translateY(-50%) scale(0);
        width: 50px;
        height: 50px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        z-index: 30; /* Above overlays */
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0;
        pointer-events: auto; /* Enable clicking */
    }

    .cert-card:hover .zoom-btn-left {
        transform: translateY(-50%) scale(1);
        opacity: 1;
    }

    .zoom-btn-left:hover {
        background: #eb0a1e;
        transform: translateY(-50%) scale(1.1);
    }
</style>

<section class="cert-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="min-height: 350px; padding-top: 120px; background: url('{{ asset('assets/img/kyb3.png') }}') no-repeat center center/cover;">
    <!-- Dark Gradient Overlay -->
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(58, 2, 6, 0.7) 100%);"></div>

    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: url('{{ asset('assets/img/pattern.png') }}') repeat; opacity: 0.05;"></div>

    <!-- Animated shapes -->
    <div class="position-absolute rounded-circle bg-danger opacity-25 blur-xl" style="width: 300px; height: 300px; top: -100px; right: -50px; filter: blur(80px);"></div>

    <div class="container position-relative z-2 text-center animate-on-scroll fade-down">
        <h1 class="display-4 fw-bold mb-3">Our Sertificate</h1>
    </div>
</section>

<!-- Certificate Grid Section -->
<section class="py-5 bg-white position-relative">
    <div class="container py-5">

        <!-- Section Header -->
        <div class="text-center mb-5 animate-on-scroll fade-up">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <span class="d-inline-block bg-danger" style="width: 40px; height: 1px;"></span>
                <span class="mx-3 text-uppercase fw-bold text-danger tracking-wider small">CHECK OUR CERTIFICATE </span>
                <span class="d-inline-block bg-danger" style="width: 40px; height: 1px;"></span>
            </div>
            <h2 class="display-6 fw-bold mb-3 text-dark">Sertifikasi Kami <br> Dedikasi Kami untuk Kualitas</h2>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Kami bangga dengan pencapaian yang telah kami raih. Berikut adalah beberapa sertifikasi dan penghargaan yang membuktikan komitmen kami terhadap standar internasional.
            </p>
        </div>

        <!-- Grid -->
        <div class="row g-4 justify-content-center">
            @forelse($events as $index => $event)
            @php $delays = ['delay-100','delay-200','delay-300']; $delay = $delays[$index % 3]; @endphp
            <div class="col-lg-4 col-md-6 animate-on-scroll fade-up {{ $delay }}">
                <div class="cert-card position-relative overflow-hidden rounded-4 shadow-sm" style="height: 400px;">
                    <div class="cert-img-wrapper h-100 w-100 position-relative">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-100 h-100 object-fit-cover cert-img">
                            <div class="zoom-btn-left" onclick="openLightbox('{{ asset('storage/' . $event->image) }}')">
                                <i class="bi bi-arrows-fullscreen"></i>
                            </div>
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                <i class="bi bi-patch-check" style="font-size: 4rem; color: #ccc;"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Default State -->
                    <div class="default-overlay position-absolute bottom-0 start-0 w-100 p-4 text-center text-white">
                        <h3 class="fw-bold mb-0">{{ $event->title }}</h3>
                        <p class="small mb-0 opacity-75">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</p>
                    </div>

                    <!-- Hover State -->
                    <div class="hover-overlay position-absolute top-0 start-0 w-100 h-100 bg-danger d-flex flex-column justify-content-center align-items-center p-4 text-white text-center" style="pointer-events: none;">
                        <i class="bi bi-award fs-1 mb-3"></i>
                        <h3 class="fw-bold mb-2">{{ $event->title }}</h3>
                        <p class="mb-4 opacity-90">{{ $event->description }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-patch-check" style="font-size: 3rem; color: #ccc; display: block; margin-bottom: 15px;"></i>
                <p class="text-muted">Belum ada data sertifikat. Tambahkan melalui Admin Panel → Pencapaian → Sertifikat.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="imageLightbox" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="" id="lightboxImage" class="img-fluid rounded shadow-lg" alt="Full View">
            </div>
        </div>
    </div>
</div>


<script>
    function openLightbox(imageSrc) {
        const modalEl = document.getElementById('imageLightbox');
        const modal = new bootstrap.Modal(modalEl);
        document.getElementById('lightboxImage').src = imageSrc;
        modal.show();
    }

    document.addEventListener("DOMContentLoaded", function () {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); // Run animation once
                }
            });
        }, observerOptions);

        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        animatedElements.forEach(el => observer.observe(el));
    });
</script>
@endsection
