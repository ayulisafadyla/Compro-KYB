@extends('layouts.app')
@section('title', 'Event & Kegiatan - KYB Indonesia')
@section('content')

<style>
    main {
        margin-top: 0 !important;
    }

    .tracking-wider {
        letter-spacing: 2px;
    }

    /* Stats Icons Hover */
    .stat-item .icon-box i {
        transition: transform 0.3s ease;
    }
    .stat-item:hover .icon-box i {
        transform: scale(1.2);
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
</style>

<section class="cert-hero position-relative d-flex align-items-center justify-content-center text-white overflow-hidden" style="min-height: 350px; padding-top: 120px; background: url('{{ asset('assets/img/kyb3.png') }}') no-repeat center center/cover;">
    <!-- Dark Gradient Overlay -->
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(58, 2, 6, 0.7) 100%);"></div>

    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: url('{{ asset('assets/img/pattern.png') }}') repeat; opacity: 0.05;"></div>

    <!-- Animated shapes -->
    <div class="position-absolute rounded-circle bg-danger opacity-25 blur-xl" style="width: 300px; height: 300px; top: -100px; right: -50px; filter: blur(80px);"></div>

    <div class="container position-relative z-2 text-center animate-on-scroll fade-down">
        <h1 class="display-4 fw-bold mb-3">Our Events</h1>
    </div>
</section>

<!-- Certificate Grid Section -->
<section class="py-5 bg-white position-relative">
    <div class="container py-5">

        <!-- Section Header -->
        <div class="text-center mb-5 animate-on-scroll fade-up">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <span class="d-inline-block bg-danger" style="width: 40px; height: 1px;"></span>
                <span class="mx-3 text-uppercase fw-bold text-danger tracking-wider small">OUR ACTIVITIES</span>
                <span class="d-inline-block bg-danger" style="width: 40px; height: 1px;"></span>
            </div>
            <h2 class="display-6 fw-bold mb-3 text-dark">Event & Kegiatan <br> Momen Terbaik Kami</h2>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Berbagai event dan kegiatan seru yang telah kami selenggarakan bersama mitra dan pelanggan setia kami sebagai bentuk apresiasi dan kebersamaan.
            </p>
        </div>

        <div class="event-list">
            @forelse($events as $index => $event)
            @php $isEven = $index % 2 !== 0; $delays = ['delay-100','delay-200','delay-300']; $delay = $delays[$index % 3]; @endphp
            <div class="event-card-horizontal bg-white shadow-sm mb-5 animate-on-scroll fade-up {{ $delay }}">
                <div class="row g-0 align-items-center {{ $isEven ? 'flex-lg-row-reverse' : '' }}">
                    <div class="col-lg-5">
                        <div class="event-img-wrapper cursor-zoom"
                             @if($event->image) onclick="openLightbox('{{ asset('storage/' . $event->image) }}')" @endif>
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid w-100 event-img">
                            @else
                                <div class="img-fluid w-100 event-img d-flex align-items-center justify-content-center bg-light" style="height: 250px;">
                                    <i class="bi bi-calendar-event" style="font-size: 4rem; color: #ccc;"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="event-content p-4 p-lg-5 position-relative {{ $isEven ? 'text-lg-end' : '' }}">
                            <h3 class="fw-bold mb-3 text-dark">{{ $event->title }}</h3>
                            <div class="d-flex align-items-center {{ $isEven ? 'justify-content-lg-end' : '' }} mb-3">
                                @if(!$isEven)
                                <span class="badge bg-danger me-2">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                                <small class="text-secondary"><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</small>
                                @else
                                <small class="text-secondary me-2"><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</small>
                                <span class="badge bg-danger">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                                @endif
                            </div>
                            <p class="text-muted mb-0" style="line-height: 1.8;">
                                {{ $event->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="bi bi-calendar-x" style="font-size: 3rem; color: #ccc; display: block; margin-bottom: 15px;"></i>
                <p class="text-muted">Belum ada data event. Tambahkan melalui Admin Panel → Pencapaian → Daftar Event.</p>
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

        // Counter Animation
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
