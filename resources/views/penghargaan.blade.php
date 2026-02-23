@extends('layouts.app')
@section('title', 'Penghargaan & Prestasi - KYB Indonesia')
@section('content')

<style>
    main {
        margin-top: 0 !important;
    }

    .tracking-wider {
        letter-spacing: 2px;
    }

    .stat-item .icon-box i {
        transition: transform 0.3s ease;
    }
    .stat-item:hover .icon-box i {
        transform: scale(1.2);
    }

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

    .award-card-new {
        background: transparent;
        border: none;
        margin-bottom: 2rem;
    }

    .award-img-wrapper {
        width: 100%;
        height: 350px;
        overflow: hidden;
        border-radius: 0;
    }

    .award-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .award-card-new:hover .award-img {
        transform: scale(1.05);
    }

    .award-price-bar {
        background-color: #eb0a1e;
        color: white;
        text-align: center;
        padding: 12px 0;
        width: 85%;
        margin: -25px auto 0;
        position: relative;
        z-index: 10;
        font-weight: 500;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .award-content {
        padding-top: 2rem;
    }

    .award-content h4 {
        color: #333;
    }

    .zoom-btn-left {
        position: absolute;
        top: 50%;
        left: 20px;
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
        z-index: 30;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0;
    }

    .award-card-new:hover .zoom-btn-left {
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
        <h1 class="display-4 fw-bold mb-3">Our Awards</h1>
    </div>
</section>

<!-- Certificate Grid Section -->
<section class="py-5 bg-white position-relative">
    <div class="container py-5">

        <!-- Section Header -->
        <div class="text-center mb-5 animate-on-scroll fade-up">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <span class="d-inline-block bg-danger" style="width: 40px; height: 1px;"></span>
                <span class="mx-3 text-uppercase fw-bold text-danger tracking-wider small">OUR ACHIEVEMENTS</span>
                <span class="d-inline-block bg-danger" style="width: 40px; height: 1px;"></span>
            </div>
            <h2 class="display-6 fw-bold mb-3 text-dark">Prestasi & Penghargaan <br> Bukti Keunggulan Kami</h2>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Berbagai penghargaan bergengsi yang telah kami terima sebagai bukti nyata komitmen kami dalam memberikan kualitas terbaik bagi mitra dan pelanggan.
            </p>
        </div>

        <div class="row g-4">
            @forelse($events as $index => $event)
            @php $delays = ['delay-100','delay-200','delay-300']; $delay = $delays[$index % 3]; @endphp
            <div class="col-md-4 animate-on-scroll fade-up {{ $delay }}">
                <div class="award-card-new group">
                    <div class="award-img-wrapper position-relative">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid w-100 award-img">
                            <div class="zoom-btn-left" onclick="openLightbox('{{ asset('storage/' . $event->image) }}')">
                                <i class="bi bi-arrows-fullscreen"></i>
                            </div>
                        @else
                            <div class="img-fluid w-100 award-img d-flex align-items-center justify-content-center bg-light">
                                <i class="bi bi-trophy" style="font-size: 4rem; color: #ccc;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="award-price-bar">
                        {{ \Carbon\Carbon::parse($event->date)->format('Y') }}
                    </div>
                    <div class="award-content text-center">
                        <h4 class="fw-bold mb-3 mt-2">{{ $event->title }}</h4>
                        <p class="text-muted text-center mx-auto" style="max-width: 80%;">
                            {{ $event->description }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-trophy" style="font-size: 3rem; color: #ccc; display: block; margin-bottom: 15px;"></i>
                <p class="text-muted">Belum ada data penghargaan. Tambahkan melalui Admin Panel → Pencapaian → Penghargaan.</p>
            </div>
            @endforelse
        </div>

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
        </div>
    </div>
</section>

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
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        animatedElements.forEach(el => observer.observe(el));

        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        const counters = document.querySelectorAll('.counter');
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    animateValue(entry.target, 0, target, 2000);
                    observer.unobserve(entry.target);
                }
            });
        });

        counters.forEach(counter => counterObserver.observe(counter));
    });
</script>
@endsection
