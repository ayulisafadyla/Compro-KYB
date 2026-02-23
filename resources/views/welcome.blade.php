@extends('layouts.app')
@section('content')

<style>
    main {
        margin-top: 0 !important;
    }

    .hero-carousel {
        position: relative;
        width: 100vw;
        height: 100vh;
        margin-left: calc(-50vw + 50%);
        overflow: hidden;
    }

    .carousel-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .carousel-slide.active {
        opacity: 1;
        animation: fadeIn 1.5s ease-in-out;
    }

    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(235, 10, 30, 0.5) 100%);
    }

    .carousel-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 10;
        width: 90%;
        max-width: 1000px;
    }

    .carousel-subtitle {
        font-size: 1.2rem;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 20px;
        opacity: 0;
        animation: slideUpFade 1.2s ease-out 0.2s forwards;
    }

    .carousel-title {
        font-size: 4.5rem;
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 25px;
        text-shadow: 3px 3px 15px rgba(0,0,0,0.8);
        opacity: 0;
        animation: slideUpFade 1.2s ease-out 0.5s forwards;
    }

    .carousel-description {
        font-size: 1.3rem;
        font-weight: 300;
        margin-bottom: 40px;
        opacity: 0;
        animation: slideUpFade 1.2s ease-out 0.8s forwards;
    }

    .carousel-btn {
        background: #eb0a1e;
        color: white;
        padding: 18px 50px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-block;
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        opacity: 0;
        animation: slideUpFade 1.2s ease-out 1.1s forwards;
    }

    .carousel-btn:hover {
        background: white;
        color: #eb0a1e;
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(255, 255, 255, 0.4);
    }

    /* Navigation Buttons */
    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 20;
        background: #eb0a1e;
        color: white;
        border: none;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(235, 10, 30, 0.4);
    }

    .carousel-nav:hover {
        background: #c00818;
        transform: translateY(-50%) scale(1.15);
        box-shadow: 0 8px 25px rgba(235, 10, 30, 0.7);
    }

    .carousel-nav.prev {
        left: 30px;
    }

    .carousel-nav.next {
        right: 30px;
    }

    /* Indicators */
    .carousel-indicators {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        display: flex;
        gap: 12px;
    }

    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .indicator.active {
        background: white;
        width: 40px;
        border-radius: 6px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(80px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .carousel-title {
            font-size: 2.5rem;
        }
        .carousel-subtitle {
            font-size: 0.9rem;
        }
        .carousel-description {
            font-size: 1rem;
        }
        .carousel-nav {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }
        .carousel-nav.prev {
            left: 15px;
        }
        .carousel-nav.next {
            right: 15px;
        }
    }
</style>

<div class="hero-carousel">
    <!-- Slide 1 -->
    <div class="carousel-slide active" style="background-image: url('{{ asset('assets/img/perusahaan.jpg') }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <p class="carousel-subtitle" data-translate="slide1_subtitle">SOLUSI TERBAIK UNTUK KENDARAAN ANDA</p>
            <h1 class="carousel-title" data-translate="slide1_title">PT Kayaba Indonesia</h1>
            <p class="carousel-description" data-translate="slide1_desc">Teknologi suspensi terkemuka untuk performa maksimal kendaraan Anda</p>
            <a href="#products" class="carousel-btn" data-translate="hero_explore">Jelajahi Produk</a>
        </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-slide" style="background-image: url('{{ asset('assets/img/perusahaan.jpg') }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <p class="carousel-subtitle" data-translate="slide2_subtitle">INOVASI & KUALITAS</p>
            <h1 class="carousel-title" data-translate="slide2_title">Teknologi Terdepan</h1>
            <p class="carousel-description" data-translate="slide2_desc">Menghadirkan solusi suspensi berkualitas tinggi untuk berbagai jenis kendaraan</p>
            <a href="#about" class="carousel-btn" data-translate="hero_contact">Hubungi Kami</a>
        </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-slide" style="background-image: url('{{ asset('assets/img/perusahaan.jpg') }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <p class="carousel-subtitle" data-translate="slide3_subtitle">KEPERCAYAAN PELANGGAN</p>
            <h1 class="carousel-title" data-translate="slide3_title">Partner Terpercaya</h1>
            <p class="carousel-description" data-translate="slide3_desc">Dipercaya oleh ribuan pelanggan di seluruh Indonesia</p>
            <a href="#contact" class="carousel-btn" data-translate="hero_contact">Hubungi Kami</a>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <button class="carousel-nav prev" onclick="changeSlide(-1)">
        <i class="bi bi-chevron-left"></i>
    </button>
    <button class="carousel-nav next" onclick="changeSlide(1)">
        <i class="bi bi-chevron-right"></i>
    </button>

    <!-- Indicators -->
    <div class="carousel-indicators">
        <span class="indicator active" onclick="goToSlide(0)"></span>
        <span class="indicator" onclick="goToSlide(1)"></span>
        <span class="indicator" onclick="goToSlide(2)"></span>
    </div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    let autoSlideInterval;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(ind => ind.classList.remove('active'));

        if (index >= slides.length) currentSlide = 0;
        if (index < 0) currentSlide = slides.length - 1;

        slides[currentSlide].classList.add('active');
        indicators[currentSlide].classList.add('active');
    }

    function changeSlide(direction) {
        currentSlide += direction;
        if (currentSlide >= slides.length) currentSlide = 0;
        if (currentSlide < 0) currentSlide = slides.length - 1;
        showSlide(currentSlide);
        resetAutoSlide();
    }

    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
        resetAutoSlide();
    }

    function autoSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) currentSlide = 0;
        showSlide(currentSlide);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(autoSlide, 5000);
    }

    // Auto slide every 5 seconds
    autoSlideInterval = setInterval(autoSlide, 5000);

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') changeSlide(-1);
        if (e.key === 'ArrowRight') changeSlide(1);
    });
</script>
@endsection
