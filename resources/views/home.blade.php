@extends('layouts.app')

@section('content')
<style>
    main {
        margin-top: 0 !important;
    }
    
    .hero-carousel {
        position: relative;
        width: 100%;
        height: 100vh;
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
    }
    
    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.5) 0%, rgba(235, 10, 30, 0.4) 100%);
    }
    
    .carousel-content {
        position: absolute;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 10;
        width: 90%;
        max-width: 1000px;
    }
    
    .carousel-subtitle {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 15px;
        opacity: 0;
        animation: slideUpFade 1.5s ease-out 0.3s forwards;
    }
    
    .carousel-title {
        font-size: 2.8rem;
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 20px;
        text-shadow: 3px 3px 20px rgba(0,0,0,0.8);
        opacity: 0;
        animation: slideUpFade 1.5s ease-out 0.7s forwards;
    }
    
    .carousel-description {
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 30px;
        opacity: 0;
        animation: slideUpFade 1.5s ease-out 1.1s forwards;
        max-width: 650px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.8);
    }
    
    .carousel-btn {
        background: #eb0a1e;
        color: white;
        padding: 14px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-block;
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(235, 10, 30, 0.4);
        opacity: 0;
        animation: slideUpFade 1.5s ease-out 1.5s forwards;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .carousel-btn:hover {
        background: #c00818;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(235, 10, 30, 0.6);
    }
    
    /* Navigation Buttons - MERAH */
    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 20;
        background: rgba(235, 10, 30, 0.5);
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 1.3rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(235, 10, 30, 0.3);
    }
    
    .carousel-nav:hover {
        background: rgba(235, 10, 30, 0.8);
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 5px 15px rgba(235, 10, 30, 0.5);
    }
    
    .carousel-nav.prev {
        left: 30px;
    }
    
    .carousel-nav.next {
        right: 30px;
    }
    
    /* Indicators */
    /* Custom Indicators */
    .custom-carousel-indicators {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        display: flex;
        gap: 15px;
        width: auto;
        padding: 0;
        margin: 0;
    }
    
    .indicator {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(2px);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .indicator.active {
        background: white;
        width: 45px;
        border-radius: 7px;
        backdrop-filter: none;
        border: none;
    }
    
    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(100px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .carousel-title {
            font-size: 1.8rem;
        }
        .carousel-subtitle {
            font-size: 0.6rem;
            letter-spacing: 2px;
        }
        .carousel-description {
            font-size: 0.75rem;
            max-width: 90%;
        }
        .carousel-btn {
            padding: 12px 30px;
            font-size: 0.75rem;
        }
        .carousel-nav {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }
        .carousel-nav.prev {
            left: 15px;
        }
        .carousel-nav.next {
            right: 15px;
        }
    }
    
    @media (max-width: 480px) {
        .carousel-title {
            font-size: 1.5rem;
        }
        .carousel-subtitle {
            font-size: 0.55rem;
            letter-spacing: 1.5px;
        }
        .carousel-description {
            font-size: 0.7rem;
        }
        .carousel-btn {
            padding: 10px 25px;
            font-size: 0.7rem;
        }
    }
</style>

<div class="hero-carousel">
    <!-- Slide 1 -->
    <div class="carousel-slide active" style="background-image: url('{{ asset('assets/img/kyb1.png') }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <p class="carousel-subtitle">SOLUSI UNTUK SEMUA JENIS KENDARAAN</p>
            <h1 class="carousel-title">Sistem Suspensi<br>Dimulai Dari Sini!</h1>
            <p class="carousel-description">PT Kayaba Indonesia menghadirkan teknologi suspensi terkemuka dengan standar kualitas internasional<br>
            </p>
            <a href="#products" class="carousel-btn">Jelajahi Produk</a>
        </div>
    </div>
    
    <!-- Slide 2 -->
    <div class="carousel-slide" style="background-image: url('{{ asset('assets/img/kyb1.png') }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <p class="carousel-subtitle">INOVASI & TEKNOLOGI TERDEPAN</p>
            <h1 class="carousel-title">Kualitas Produk<br>Terjamin!</h1>
            <p class="carousel-description">Dipercaya oleh ribuan pelanggan di seluruh Indonesia dengan produk berkualitas tinggi dan layanan terbaik untuk industri otomotif.</p>
            <a href="#about" class="carousel-btn">Tentang Kami</a>
        </div>
    </div>
    
    <!-- Slide 3 -->
    <div class="carousel-slide" style="background-image: url('{{ asset('assets/img/kyb1.png') }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <p class="carousel-subtitle">KEPERCAYAAN & PENGALAMAN</p>
            <h1 class="carousel-title">Partner Terpercaya<br>Anda!</h1>
            <p class="carousel-description">Dengan pengalaman puluhan tahun, kami berkomitmen memberikan solusi terbaik untuk kebutuhan suspensi kendaraan Anda.</p>
            <a href="#contact" class="carousel-btn">Hubungi Kami</a>
        </div>
    </div>
    
    <!-- Navigation Buttons MERAH -->
    <button class="carousel-nav prev" onclick="changeSlide(-1)">
        ◀
    </button>
    <button class="carousel-nav next" onclick="changeSlide(1)">
        ▶
    </button>
    
    <!-- Indicators -->
    <div class="custom-carousel-indicators">
        <span class="indicator active" onclick="goToSlide(0)"></span>
        <span class="indicator" onclick="goToSlide(1)"></span>
        <span class="indicator" onclick="goToSlide(2)"></span>
    </div>
</div>

<style>
    .play-video-btn:hover {
        transform: translate(-50%, -50%) scale(1.1);
        background: rgba(235, 10, 30, 1) !important;
        box-shadow: 0 12px 35px rgba(235, 10, 30, 0.5) !important;
    }
    .play-video-btn::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border: 2px solid rgba(255,255,255,0.5);
        border-radius: 50%;
        animation: pulse-ring 1.5s ease-out infinite;
    }
    @keyframes pulse-ring {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.5); opacity: 0; }
    }
    
    /* Overlapping Circular Frames for About Section - Red Theme */
    .about-circle-small {
        position: absolute;
        left: 0;
        top: 65%;
        transform: translateY(-50%);
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 8px solid #eb0a1e;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 8px 30px rgba(235, 10, 30, 0.25);
        background: white;
    }
    
    .about-circle-small img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .about-circle-large {
        position: relative;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        border: 8px solid #eb0a1e;
        overflow: hidden;
        z-index: 2;
        box-shadow: 0 15px 50px rgba(235, 10, 30, 0.3);
        margin-left: 80px;
        background: white;
    }
    
    .about-circle-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    @media (max-width: 968px) {
        .about-section-grid {
            grid-template-columns: 1fr !important;
            gap: 30px !important;
        }
        .about-circles-container {
            justify-content: center !important;
            padding-left: 0 !important;
        }
    }
    
    @media (max-width: 768px) {
        .about-circle-small {
            width: 120px;
            height: 120px;
            left: 10px;
        }
        .about-circle-large {
            width: 220px;
            height: 220px;
            margin-left: 50px;
        }
    }
    
    /* Read More Button - Red Theme */
    .read-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 30px;
        background: #eb0a1e;
        color: white;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(235, 10, 30, 0.3);
    }
    
    .read-more-btn:hover {
        background: #c00818;
        transform: translateX(5px);
        box-shadow: 0 6px 25px rgba(235, 10, 30, 0.4);
    }
    
    .read-more-btn svg {
        transition: transform 0.3s ease;
    }
    
    .read-more-btn:hover svg {
        transform: translateX(5px);
    }
    
    /* Philosophy Modal Styles - Clean & Elegant */
    .philosophy-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(5px);
    }
    
    .philosophy-modal-overlay.show {
        display: flex;
        opacity: 1;
    }
    
    .philosophy-modal {
        background: white;
        border-radius: 24px;
        max-width: 600px;
        width: 90%;
        position: relative;
        transform: scale(0.9);
        transition: transform 0.3s ease;
        overflow: hidden;
    }
    
    .philosophy-modal-overlay.show .philosophy-modal {
        transform: scale(1);
    }
    
    .philosophy-modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.2);
        border: none;
        border-radius: 50%;
        font-size: 1.3rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: all 0.3s ease;
        color: white;
    }
    
    .philosophy-modal-close:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(90deg);
    }
    
    .philosophy-modal-header {
        background: linear-gradient(135deg, #eb0a1e 0%, #c00818 100%);
        padding: 50px 40px 40px;
        text-align: center;
    }
    
    .philosophy-modal-header h2 {
        color: white;
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0 0 8px 0;
    }
    
    .philosophy-modal-header p {
        color: rgba(255,255,255,0.85);
        font-size: 0.9rem;
        margin: 0;
    }
    
    .philosophy-modal-content {
        padding: 30px 40px 40px;
        text-align: center;
    }
    
    .philosophy-quote {
        font-size: 1.1rem;
        color: #333;
        line-height: 1.9;
        margin-bottom: 30px;
        font-style: italic;
        position: relative;
        padding: 0 20px;
    }
    
    .philosophy-quote::before {
        content: '"';
        font-size: 4rem;
        color: #eb0a1e;
        opacity: 0.2;
        position: absolute;
        top: -20px;
        left: -10px;
        font-family: Georgia, serif;
    }
    
    .philosophy-values-simple {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        margin-top: 25px;
    }
    
    .philosophy-value-simple {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    
    .philosophy-value-simple .icon-circle {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #fff5f5 0%, #ffe8ea 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .philosophy-value-simple:hover .icon-circle {
        background: linear-gradient(135deg, #eb0a1e 0%, #c00818 100%);
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(235, 10, 30, 0.3);
    }
    
    .philosophy-value-simple:hover .icon-circle svg {
        stroke: white;
    }
    
    .philosophy-value-simple span {
        font-size: 0.85rem;
        font-weight: 600;
        color: #333;
    }
    
    @media (max-width: 640px) {
        .philosophy-modal-header {
            padding: 40px 25px 30px;
        }
        .philosophy-modal-content {
            padding: 25px;
        }
        .philosophy-values-simple {
            gap: 20px;
        }
        .philosophy-value-simple .icon-circle {
            width: 50px;
            height: 50px;
        }
    }
</style>

<!-- About Us Section - Static 3-Column Layout -->
<section id="about" style="padding: 100px 30px; background: white; overflow: hidden;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Section Header matching "ABOUT US" style -->
        <div style="text-align: center; margin-bottom: 60px;">
             <h2 style="font-size: 2rem; font-weight: 500; color: #eb0a1e; margin: 0; letter-spacing: 2px;">TENTANG KAMI</h2>
             <p style="color: #666; font-size: 0.7rem; margin: 10px 0 0 0; letter-spacing: 1px; text-transform: uppercase;">PERUSAHAAN KAMI, DENGAN KATA-KATA SEDERHANA</p>
             <div style="width: 60px; height: 1px; background: #666; margin: 20px auto 0;"></div>
        </div>

        <div class="about-grid-static" style="display: grid; grid-template-columns: 1fr 1.2fr 1fr; gap: 40px; align-items: flex-start;">
            
            <!-- Left Column: Sejarah Perusahaan -->
            <div class="scroll-animate-right" style="text-align: right;">
                <h3 style="font-size: 1.5rem; font-weight: 500; color: #333; margin: 0 0 15px 0; letter-spacing: 2px;">SEJARAH PERUSAHAAN</h3>
                <p style="color: #666; line-height: 1.8; font-size: 0.95rem; margin-bottom: 0;">
                   PT Kayaba Indonesia didirikan pada 25 Februari 1976 dengan nama awal PT Kayaba Jepang kemudian menjalin kerja sama dengan PT Astra Otoparts Tbk. dan berkembang menjadi PT Kayaba Indonesia.
                Saat ini Perusahaan memproduksi berbagai komponen suspensi, seperti front fork dan oil cushion unit, serta terus mengembangkan inovasi teknologi dan proses produksi untuk meningkatkan kualitas, variasi produk, serta efisiensi dan efektivitas guna memenuhi kebutuhan pasar shock absorber.
            </p>
            </div>

            <!-- Center Column: Image -->
            <div class="scroll-animate-up" style="position: relative; display: flex; justify-content: center;">
                 <!-- Image Container - Smaller & No Frame -->
                 <div style="position: relative; width: 100%; max-width: 320px; margin: 0 auto;">
                    
                    <!-- Main Image Container -->
                    <div style="position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 2;">
                        <img src="{{ asset('assets/img/kyb2.jpeg') }}" alt="PT Kayaba Indonesia" style="width: 100%; height: 350px; object-fit: cover; display: block;">
                        
                        <!-- Overlay Gradient (Softer) -->
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100px; background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 100%);"></div>
                    
                    </div>
                </div>
            </div>

            <!-- Right Column: VISI & MISI -->
            <div class="scroll-animate-left" style="text-align: left;">
                <h3 style="font-size: 1.5rem; font-weight: 500; color: #333; margin: 0 0 15px 0; letter-spacing: 2px;">VISI & MISI</h3>
                <div style="color: #666; line-height: 1.8; font-size: 0.95rem;">
                    <p style="margin-bottom: 15px;">
                        <strong>Visi PT Kayaba Indonesia</strong><br>
                        “To be world wide shock absorber production base for KYB group”.
                    </p>
                    <p style="margin: 0;">
                        <strong>Misi PT Kayaba Indonesia</strong><br>
                        1. To be Number One in Cost and Quality for Two Wheelers in Shock Absorber in the World.<br>
                        2. To Implement Astra Green Company, Astra Friendly Company, Security Community Dev & IR Management System, and KIPKA.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Video Banner Section -->
<section id="video-banner" style="position: relative; padding: 100px 20px; text-align: center; color: white; overflow: hidden;">
    <!-- Parallax Background -->
    <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 100vw; height: 100%; background-image: url('{{ asset('assets/img/kyb3.png') }}'); background-size: cover; background-position: center; z-index: 0;"></div>
    
    <!-- Dark Overlay -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1;"></div>
    
    <!-- Content Container -->
    <div class="video-content" style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; gap: 60px;">
        
        <!-- Left Text: WATCH OUR VIDEO -->
        <div class="video-text-left scroll-animate-left" style="text-align: right; flex: 1;">
            <h2 style="font-size: 1.5rem; font-weight: 400; margin: 0; letter-spacing: 2px; line-height: 1;">
                TONTON VIDEO <br> KAMI
            </h2>
        </div>
        
        <!-- Center Button: Play -->
        <div class="video-play-btn scroll-animate-up">
            <a href="#" class="play-btn-circle" data-bs-toggle="modal" data-bs-target="#videoConfirmationModal">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 4px;">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </a>
        </div>
        
        <!-- Right Text: Slogan -->
        <div class="video-text-right scroll-animate-right" style="text-align: left; flex: 1;">
            <p style="font-size: 1.2rem; margin: 0; line-height: 1.6; font-weight: 300; opacity: 0.9;">
                Presisi Kami<br>
                Keuntungan Anda<br>
            </p>
        </div>
    </div>
</section>

<!-- Video Confirmation Modal -->
<div class="modal fade" id="videoConfirmationModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true" style="z-index: 10000;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            <div class="modal-body text-center" style="padding: 20px 30px;">
                <div style="width: 80px; height: 80px; background: rgba(235, 10, 30, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="bi bi-youtube" style="font-size: 40px; color: #eb0a1e;"></i>
                </div>
                <h4 style="font-weight: 700; margin-bottom: 15px; color: #333;">Buka YouTube?</h4>
                <p style="color: #666; margin-bottom: 30px; font-size: 0.95rem;">Apakah Anda mengizinkan untuk membuka video ini di YouTube?</p>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="padding: 12px 35px; border-radius: 50px; font-weight: 600; background: #f0f0f0; color: #333; border: none; transition: 0.3s;">Tidak</button>
                    <a href="https://www.youtube.com/watch?v=2h5unVOZvL4" target="_blank" onclick="var myModalEl = document.getElementById('videoConfirmationModal'); var modal = bootstrap.Modal.getInstance(myModalEl); modal.hide();" class="btn" style="background: #eb0a1e; color: white; border: none; padding: 12px 35px; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 15px rgba(235, 10, 30, 0.3); transition: 0.3s;">Ya</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .play-btn-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border: 2px solid rgba(255,255,255,0.8);
        border-radius: 50%;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .play-btn-circle:hover {
        background: #eb0a1e;
        color: white;
        transform: scale(1.1);
        border-color: #eb0a1e;
        box-shadow: 0 0 30px rgba(235, 10, 30, 0.4);
    }

    @media (max-width: 768px) {
        .video-content {
            flex-direction: column !important;
            gap: 30px !important;
        }
        
        .video-text-left, .video-text-right {
            text-align: center !important;
        }
        
        .play-btn-circle {
            width: 60px;
            height: 60px;
        }
    }
</style>

<style>
    @media (max-width: 968px) {
        .about-grid-static {
            grid-template-columns: 1fr !important;
            gap: 50px !important;
            text-align: center !important;
        }
        
        /* Reset content alignment for mobile */
        .scroll-animate-right, 
        .scroll-animate-left {
            text-align: center !important;
        }
        
        .scroll-animate-right > div,
        .scroll-animate-left > div {
            align-items: center !important;
        }
        
        .scroll-animate-right > div > div {
            flex-direction: row !important; /* Reset row-reverse */
        }
        
        /* Reorder for mobile: Image first */
        .about-grid-static > div:nth-child(2) {
            order: -1;
        }
    }
    
    /* Reuse scroll animations */
    .scroll-animate-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    
    .scroll-animate-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    // Keep only Intersection Observer for scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Add active class for side animations if needed
                    entry.target.classList.add('active'); 
                }
            });
        }, observerOptions);
        
        // Observe all elements with animation classes
        document.querySelectorAll('.scroll-animate-up, .scroll-animate-right, .scroll-animate-left').forEach(el => {
            observer.observe(el);
        });
    });
</script>

<!-- Philosophy Modal -->
<div class="philosophy-modal-overlay" id="philosophyModal">
    <div class="philosophy-modal">
        <button class="philosophy-modal-close" onclick="closePhilosophyModal()">×</button>
        
        <div class="philosophy-modal-header">
            <h2>Filosofi Perusahaan</h2>
            <p>Prinsip dan nilai-nilai yang menjadi landasan PT Kayaba Indonesia</p>
        </div>
        
        <div class="philosophy-modal-content">
            <!-- Simple Philosophy Quote -->
            <p class="philosophy-quote">
                Kami percaya bahwa kualitas adalah fondasi kepercayaan. Dengan pengalaman lebih dari 48 tahun, kami berkomitmen untuk menghadirkan produk terbaik dan menjadi mitra terpercaya bagi industri otomotif Indonesia.
            </p>
            
            <!-- Core Values with Simple Icons -->
            <div class="philosophy-values-simple">
                <div class="philosophy-value-simple">
                    <div class="icon-circle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#eb0a1e" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <span>Kualitas</span>
                </div>
                <div class="philosophy-value-simple">
                    <div class="icon-circle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#eb0a1e" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <span>Konsisten</span>
                </div>
                <div class="philosophy-value-simple">
                    <div class="icon-circle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#eb0a1e" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <span>Kemitraan</span>
                </div>
                <div class="philosophy-value-simple">
                    <div class="icon-circle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#eb0a1e" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <span>Terpercaya</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Philosophy Modal Functions
    function openPhilosophyModal() {
        const modal = document.getElementById('philosophyModal');
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
        document.body.style.overflow = 'hidden';
    }
    
    function closePhilosophyModal() {
        const modal = document.getElementById('philosophyModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
        document.body.style.overflow = '';
    }
    
    // Close modal when clicking outside
    document.getElementById('philosophyModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePhilosophyModal();
        }
    });
    
    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePhilosophyModal();
        }
    });
</script>




<!-- Products Section - Toyota Style -->
<section id="products" style="padding: 60px 20px 40px 20px; background: white; position: relative;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Section Header -->
        <div class="scroll-animate-up" style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-size: 2rem; font-weight: 500; color: #eb0a1e; margin: 0; letter-spacing: 2px;">JELAJAHI PRODUK</h2>
            <p style="color: #666; font-size: 0.7rem; margin: 10px 0 0 0; letter-spacing: 1px; text-transform: uppercase;">KUALITAS OEM & OES TERBAIK</p>
            <div style="width: 60px; height: 1px; background: #666; margin: 20px auto 0;"></div>
        </div>
        
        <!-- Tab Navigation - Underline Style -->
        <div style="display: flex; justify-content: center; border-bottom: 1px solid #e0e0e0; margin-bottom: 25px;">
            <button class="product-tab-v2 active" data-tab="2w" style="padding: 15px 40px; background: none; border: none; font-size: 1rem; font-weight: 600; color: #333; cursor: pointer; position: relative; transition: all 0.3s ease;">
                2W
            </button>
            <button class="product-tab-v2" data-tab="4w" style="padding: 15px 40px; background: none; border: none; font-size: 1rem; font-weight: 600; color: #888; cursor: pointer; position: relative; transition: all 0.3s ease;">
                4W
            </button>
            <button class="product-tab-v2" data-tab="sepeda" style="padding: 15px 40px; background: none; border: none; font-size: 1rem; font-weight: 600; color: #888; cursor: pointer; position: relative; transition: all 0.3s ease;">
                Sepeda
            </button>
        </div>
        

        
        <!-- Products Grid - 2W -->
        <div class="product-content-v2 scroll-animate-up" id="tab-v2-2w" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <!-- Product Card 1 -->
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="position: absolute; top: 15px; right: 15px;">
                </div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">Rare Cushion Unit</h3>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                        </div>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/2wrarecushion.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>
            
            <!-- Product Card 2 -->
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">Front Frok</h3>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                        </div>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/2wfrontfrok.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>
            
            <!-- Product Card 3 -->
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">KYB Trail Master</h3>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/premium.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products Grid - 4W -->
        <div class="product-content-v2" id="tab-v2-4w" style="display: none; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="position: absolute; top: 15px; right: 15px;">
                    <span style="background: #00bcd4; color: white; font-size: 0.6rem; font-weight: 700; padding: 3px 8px; border-radius: 3px;">NEW!</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">KYB Excel-G</h3>
                        <p style="color: #888; font-size: 0.8rem; margin: 0 0 5px 0;">Starting from</p>
                        <p style="color: #eb0a1e; font-size: 1rem; font-weight: 700; margin: 0 0 15px 0;">Rp850.000</p>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span style="border: 1px solid #333; color: #333; font-size: 0.6rem; font-weight: 600; padding: 3px 8px; border-radius: 3px;">SUV</span>
                            <span style="border: 1px solid #333; color: #333; font-size: 0.6rem; font-weight: 600; padding: 3px 8px; border-radius: 3px;">MPV</span>
                        </div>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/kyb1.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">KYB Gas-A-Just</h3>
                        <p style="color: #888; font-size: 0.8rem; margin: 0 0 5px 0;">Starting from</p>
                        <p style="color: #eb0a1e; font-size: 1rem; font-weight: 700; margin: 0 0 15px 0;">Rp720.000</p>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span style="border: 1px solid #333; color: #333; font-size: 0.6rem; font-weight: 600; padding: 3px 8px; border-radius: 3px;">CITY CAR</span>
                        </div>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/kyb1.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">KYB MonoMax</h3>
                        <p style="color: #888; font-size: 0.8rem; margin: 0 0 5px 0;">Starting from</p>
                        <p style="color: #eb0a1e; font-size: 1rem; font-weight: 700; margin: 0 0 15px 0;">Rp950.000</p>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span style="border: 1px solid #333; color: #333; font-size: 0.6rem; font-weight: 600; padding: 3px 8px; border-radius: 3px;">PICK UP</span>
                        </div>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/kyb1.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products Grid - Sepeda -->
        <div class="product-content-v2" id="tab-v2-sepeda" style="display: none; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="position: absolute; top: 15px; right: 15px;">
                    <span style="background: #00bcd4; color: white; font-size: 0.6rem; font-weight: 700; padding: 3px 8px; border-radius: 3px;">NEW!</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">KYB Fork Suspension</h3>
                        <p style="color: #888; font-size: 0.8rem; margin: 0 0 5px 0;">Starting from</p>
                        <p style="color: #eb0a1e; font-size: 1rem; font-weight: 700; margin: 0 0 15px 0;">Rp1.200.000</p>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span style="border: 1px solid #333; color: #333; font-size: 0.6rem; font-weight: 600; padding: 3px 8px; border-radius: 3px;">MTB</span>
                        </div>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/kyb1.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 20px; position: relative; transition: all 0.3s ease;" class="product-card-v2">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="flex: 1;">
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0 0 10px 0; line-height: 1.3;">KYB E-Bike Shock</h3>
                        <p style="color: #888; font-size: 0.8rem; margin: 0 0 5px 0;">Starting from</p>
                        <p style="color: #eb0a1e; font-size: 1rem; font-weight: 700; margin: 0 0 15px 0;">Rp980.000</p>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span style="border: 1px solid #333; color: #333; font-size: 0.6rem; font-weight: 600; padding: 3px 8px; border-radius: 3px;">E-BIKE</span>
                        </div>
                    </div>
                    <div style="width: 140px; flex-shrink: 0;">
                        <img src="{{ asset('assets/img/kyb1.png') }}" alt="KYB Product" style="width: 100%; height: 100px; object-fit: contain;">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Partners/Brands Section - Step Carousel Style -->
<section id="partners" style="padding: 40px 0; background: #eb0a1e; position: relative; overflow: hidden;">
    
    <div style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 10;">
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-size: 1.8rem; font-weight: 500; color: #fff; margin: 0; letter-spacing: 2px;">KERJASAMA BRAND</h2>
            <div style="width: 50px; height: 1px; background: #fff; margin: 15px auto 0;"></div>
        </div>
        
        <!-- Carousel Window -->
        <div class="carousel-window" style="overflow: hidden; width: 100%; position: relative;">
            <div class="carousel-track" style="display: flex; gap: 20px; width: max-content;">
                <!-- Original Set (10 items) -->
                @for ($i = 0; $i < 10; $i++)
                <div class="partner-card">
                    <img src="{{ asset('assets/img/kybLogo.png') }}" alt="Partner Logo">
                </div>
                @endfor

                <!-- Duplicate Set for Seamless Loop -->
                @for ($i = 0; $i < 10; $i++)
                <div class="partner-card">
                    <img src="{{ asset('assets/img/kybLogo.png') }}" alt="Partner Logo">
                </div>
                @endfor
            </div>
        </div>
    </div>

    <style>
        /* 
           Animation Logic: Move one item, then pause.
           Item width: 140px + 20px gap = 160px per step.
           Total 10 items = 1600px per cycle.
           Duration: 40s (4s per item: 2s slide, 2s pause).
        */
        @keyframes step-pause-scroll {
            0%, 5% { transform: translateX(0); }
            10%, 15% { transform: translateX(-160px); }
            20%, 25% { transform: translateX(-320px); }
            30%, 35% { transform: translateX(-480px); }
            40%, 45% { transform: translateX(-640px); }
            50%, 55% { transform: translateX(-800px); }
            60%, 65% { transform: translateX(-960px); }
            70%, 75% { transform: translateX(-1120px); }
            80%, 85% { transform: translateX(-1280px); }
            90%, 95% { transform: translateX(-1440px); }
            100% { transform: translateX(-1600px); }
        }
        
        .carousel-track {
            animation: step-pause-scroll 40s linear infinite; 
            /* Linear easing between keyframes creates smooth slide, flat keyframes create pause */
        }

        .carousel-window:hover .carousel-track {
            animation-play-state: paused;
        }

        .partner-card {
            width: 140px;
            height: 90px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            cursor: pointer;
            flex-shrink: 0; 
        }

        .partner-card img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            filter: grayscale(100%) opacity(0.7);
            transition: all 0.4s ease;
        }

        .partner-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            z-index: 10;
        }

        .partner-card:hover img {
            filter: grayscale(0%) opacity(1);
            transform: scale(1.05);
        }
        
        @media (max-width: 768px) {
            .partner-card {
                width: 120px;
                height: 70px;
                padding: 10px;
            }
            /* 120 + 20 gap = 140px unit */
            @keyframes step-pause-scroll-mobile {
                0%, 5% { transform: translateX(0); }
                10%, 15% { transform: translateX(-140px); }
                20%, 25% { transform: translateX(-280px); }
                30%, 35% { transform: translateX(-420px); }
                40%, 45% { transform: translateX(-560px); }
                50%, 55% { transform: translateX(-700px); }
                60%, 65% { transform: translateX(-840px); }
                70%, 75% { transform: translateX(-980px); }
                80%, 85% { transform: translateX(-1120px); }
                90%, 95% { transform: translateX(-1260px); }
                100% { transform: translateX(-1400px); }
            }
            .carousel-track {
                animation-name: step-pause-scroll-mobile;
            }
        }
    </style>
</section>

<!-- FAQ Section -->
<section id="faq" style="padding: 100px 20px; background: white; position: relative; overflow: hidden;">
    <!-- Background Elements -->
    <div style="position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(235, 10, 30, 0.03) 0%, transparent 70%); border-radius: 50%; z-index: 0;"></div>
    <div style="position: absolute; bottom: 50px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(235, 10, 30, 0.02) 0%, transparent 70%); border-radius: 50%; z-index: 0;"></div>

    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1.4fr; gap: 80px; position: relative; z-index: 1;">
        <!-- Left Column: Title & Description -->
        <div class="scroll-animate-right" style="padding-top: 20px;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <div style="width: 40px; height: 3px; background: #eb0a1e;"></div>
                <h2 style="font-size: 2rem; font-weight: 500; color: #eb0a1e; margin: 0; letter-spacing: 2px;">PUSAT DUKUNGAN</h2>
            </div>
            <p style="color: #666; line-height: 1.8; margin-bottom: 40px; font-size: 0.85rem;">
                Temukan jawaban atas pertanyaan umum seputar produk dan layanan PT Kayaba Indonesia. Kami berdedikasi untuk memberikan informasi yang jelas dan transparan kepada pelanggan kami.
            </p>
            
           
                
              

        </div>

        <!-- Right Column: Accordion -->
        <div class="faq-accordion scroll-animate-left">
            <!-- Item 1 -->
            <div class="faq-item">
                <div class="faq-header">
                    <h3>Apa keunggulan Shock Absorber KYB?</h3>
                    <div class="faq-icon-wrapper">
                        <span class="faq-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="faq-body"> <!-- Initially closed -->
                    <div class="faq-content">
                        <p>KYB Shock Absorber diproduksi dengan teknologi Jepang yang canggih dan melalui kontrol kualitas yang ketat (QC). Produk kami dirancang untuk memberikan kenyamanan maksimal, kestabilan berkendara, dan daya tahan yang lama di berbagai kondisi jalan di Indonesia.</p>
                    </div>
                </div>
            </div>
            
            
            <!-- Item 2 -->
            <div class="faq-item">
                <div class="faq-header">
                    <h3>Apakah KYB menyediakan garansi untuk produknya?</h3>
                    <div class="faq-icon-wrapper">
                        <span class="faq-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="faq-body">
                    <div class="faq-content">
                        <p>Ya, kami memberikan garansi untuk cacat produksi. Syarat dan ketentuan garansi berlaku dan dapat diklaim melalui tempat pembelian resmi dengan menyertakan bukti pembelian.</p>
                    </div>
                </div>
            </div>
            
            <!-- Item 3 -->
            <div class="faq-item">
                <div class="faq-header">
                    <h3>Di mana saya bisa membeli produk KYB?</h3>
                    <div class="faq-icon-wrapper">
                        <span class="faq-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="faq-body">
                    <div class="faq-content">
                        <p>Produk KYB tersedia di seluruh Indonesia melalui jaringan distributor resmi, bengkel rekanan, dan toko suku cadang terpercaya. Anda juga bisa menemukannya di marketplace resmi kami.</p>
                    </div>
                </div>
            </div>
            
             <!-- Item 4 -->
            <div class="faq-item">
                <div class="faq-header">
                    <h3>Apakah KYB shock absorber cocok untuk semua jenis kendaraan?</h3>
                    <div class="faq-icon-wrapper">
                        <span class="faq-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="faq-body">
                    <div class="faq-content">
                        <p>PT Kayaba Indonesia memproduksi berbagai jenis peredam kejut untuk hampir semua merek dan tipe kendaraan yang beredar di Indonesia, baik roda dua maupun roda empat. Silakan cek katalog produk kami untuk kecocokan spesifik.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" style="padding: 0 20px 80px 20px; background: #fff; position: relative; overflow: hidden;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Section Header -->
        <div class="scroll-animate-up" style="text-align: center; margin-bottom: 15px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 5px;">
                <div style="width: 40px; height: 3px; background: #eb0a1e;"></div>
                <p style="color: #eb0a1e; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; margin: 0; letter-spacing: 1.5px;">HUBUNGI KAMI</p>
                <div style="width: 40px; height: 3px; background: #eb0a1e;"></div>
            </div>
            <h2 style="font-size: 2.5rem; font-weight: 900; color: #333; margin: 0; line-height: 1.2;">Untuk Setiap <span style="color: #eb0a1e;">Pertanyaan</span></h2>
        </div>

        <!-- Contact Info Cards -->
        <div class="scroll-animate-up" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px;">
            <!-- Call Us Card -->
            <div class="contact-card">
                <div class="contact-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <h3>Hubungi Kami</h3>
                <p>+62 21 8981456</p>
            </div>

             <!-- Email Us Card -->
            <div class="contact-card">
                <div class="contact-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <h3>Alamat</h3>
                <p>Jl. Jawa No.4, Blok II, Jatiwangi Cikarang Barat, Bekasi 17530</p>
            </div>
            
             <!-- Address Card -->
            <div class="contact-card">
                <div class="contact-icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <h3>Email Kami</h3>
                <p>info@kyb.astra.co.id</p>

            </div>
        </div>

        <!-- Map & Form -->
        <div style="display: grid; grid-template-columns: 0.8fr 1.2fr; gap: 30px;">
            <!-- Map -->
            <div class="scroll-animate-right" style="background: white; padding: 10px; border-radius: 8px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); height: 320px; display: flex;">
                <iframe src="https://maps.google.com/maps?q=Kayaba%20Indonesia%20Pt.,%20Jl.%20Jawa%20No.4,%20Blok%20ii,%20Jatiwangi,%20Cikarang%20Barat&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <!-- Contact Form -->
            <div class="scroll-animate-left contact-form-container" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); height: 320px; display: flex; flex-direction: column; justify-content: center;">
                <form action="#" method="post" id="contactForm" style="width: 100%;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 12px;">
                        <input type="text" name="name" placeholder="Nama Anda" required style="width: 100%; padding: 12px 15px; border: 1px solid #eee; border-radius: 4px; background: #fff; font-size: 0.85rem;">
                        <input type="email" name="email" placeholder="Email Anda" required style="width: 100%; padding: 12px 15px; border: 1px solid #eee; border-radius: 4px; background: #fff; font-size: 0.85rem;">
                    </div>
                    <div style="margin-bottom: 12px;">
                        <input type="text" name="subject" placeholder="Subjek" required style="width: 100%; padding: 12px 15px; border: 1px solid #eee; border-radius: 4px; background: #fff; font-size: 0.85rem;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <textarea name="message" rows="3" placeholder="Pesan" required style="width: 100%; padding: 12px 15px; border: 1px solid #eee; border-radius: 4px; background: #fff; font-size: 0.85rem; resize: none;"></textarea>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" style="background: linear-gradient(135deg, #eb0a1e 0%, #ffffff 250%); color: #fff; padding: 12px 40px; border: 2px solid #eb0a1e; border-radius: 50px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(235, 10, 30, 0.2); font-size: 0.9rem;">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const header = item.querySelector('.faq-header');
            
            header.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.faq-body').style.maxHeight = null;
                    }
                });
                
                // Toggle current item
                if (isActive) {
                    item.classList.remove('active');
                    item.querySelector('.faq-body').style.maxHeight = null;
                } else {
                    item.classList.add('active');
                    const body = item.querySelector('.faq-body');
                    body.style.maxHeight = body.scrollHeight + "px";
                }
            });
        });
    });
</script>

<style>
    .btn-faq {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 18px 35px;
        background: #eb0a1e;
        color: white;
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(235, 10, 30, 0.25);
        align-self: flex-start;
        border: 2px solid #eb0a1e;
    }
    .btn-faq:hover {
        background: transparent;
        color: #eb0a1e;
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(235, 10, 30, 0.15);
    }
    .btn-faq svg {
        transition: transform 0.3s ease;
    }
    .btn-faq:hover svg {
        transform: translateX(5px);
    }
    
    .faq-item {
        margin-bottom: 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .faq-item:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.06);
        border-color: #ffe5e5;
        transform: translateY(-2px);
    }
    .faq-item.active {
        box-shadow: 0 15px 40px rgba(235, 10, 30, 0.08);
        border-color: #ffe5e5;
    }
    
    .faq-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 30px;
        cursor: pointer;
        background: white;
        transition: all 0.3s ease;
    }
    
    .faq-header h3 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #333;
        margin: 0;
        transition: color 0.3s ease;
        padding-right: 25px;
        line-height: 1.4;
    }
    
    /* When active, change title color */
    .faq-item.active .faq-header h3 {
        color: #eb0a1e;
    }
    
    .faq-icon-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    
    .faq-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        transition: all 0.3s ease;
    }
    
    .faq-item:hover .faq-icon-wrapper {
        background: #fff0f0;
        color: #eb0a1e;
    }
    
    .faq-item.active .faq-icon-wrapper {
        background: #eb0a1e;
    }
    
    .faq-item.active .faq-icon {
        color: white;
        transform: rotate(45deg);
    }
    
    .faq-body {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: #fff;
    }
    
    .faq-content {
        padding: 0 30px 30px 30px;
        border-top: 1px solid #f9f9f9;
        margin-top: -10px;
        padding-top: 20px;
    }
    
    .faq-body p {
        color: #666;
        line-height: 1.7;
        margin: 0;
        font-size: 0.85rem;
    }

    /* ABOUT US RESPONSIVE FIX */
    @media (max-width: 991px) {
        .about-grid-static {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }
        .about-grid-static > div {
            text-align: center !important;
        }
        /* Target the middle column (Image) to be first */
        .about-grid-static > div:nth-child(2) {
            order: -1;
            margin-bottom: 20px;
        }
        /* Reset text alignment for left/right columns */
        .scroll-animate-right, .scroll-animate-left {
            text-align: center !important;
        }
    }
    
    /* Responsive Styles */
    @media (max-width: 991px) {
        /* Video Banner */
        .video-content {
            flex-direction: column;
            gap: 30px !important;
            text-align: center;
        }
        .video-text-left, .video-text-right {
            text-align: center !important;
        }
        
        /* About Us */
        .about-grid-static {
            grid-template-columns: 1fr !important;
            gap: 50px !important;
        }
        .about-grid-static > div {
            text-align: center !important;
        }
        .about-grid-static .scroll-animate-right, 
        .about-grid-static .scroll-animate-left {
            text-align: center !important;
        }
        /* Reorder Image to top on mobile/tablet if needed, or keep center. 
           With 1 column, it will be Top (Text), Center (Image), Bottom (Text). 
           Maybe we want Image first? CSS Grid order can do that.
        */
        .about-grid-static > div:nth-child(2) {
            order: -1; /* Move image to top */
            margin-bottom: 30px;
        }
        
        /* FAQ */
        #faq > div {
            grid-template-columns: 1fr !important;
            gap: 50px !important;
        }
        
        /* General Headers */
        h2 {
            font-size: 2rem !important;
        }
    }
    
    @media (max-width: 576px) {
        /* Video Banner */
        .video-text-left h2 {
            font-size: 1.2rem !important;
        }
        .video-text-right p {
            font-size: 1rem !important;
        }
        .play-btn-circle {
            width: 60px !important;
            height: 60px !important;
        }
        
        /* Partners Marquee */
        .marquee-content {
            gap: 40px !important; /* Smaller gap on mobile */
        }
        .logo-item img {
            height: 30px !important; /* Smaller logos */
        }
        
        /* Section Padding */
        section {
            padding-top: 50px !important;
            padding-bottom: 50px !important;
        }
        
        /* FAQ */
        #faq {
            padding: 60px 20px !important;
        }
    }
    
    @media (max-width: 968px) {
        #faq {
            padding: 70px 20px !important;
        }
        #faq > div {
            grid-template-columns: 1fr !important;
            gap: 50px !important;
        }
        .scroll-animate-right {
           text-align: center;
        }
        .scroll-animate-right > div { /* For the button container */
           align-items: center;
        }
        .scroll-animate-right .btn-faq {
            align-self: center;
        }
        .scroll-animate-right h2 {
            font-size: 2.2rem !important;
        }
        .scroll-animate-right > div[style*="display: flex; align-items: center"] { /* Center the "Support Centre" label */
            justify-content: center;
        }
    }
    
    @media (max-width: 640px) {
        .faq-header {
            padding: 20px;
        }
        .faq-header h3 {
            font-size: 0.9rem;
        }
        .faq-content {
            padding: 0 20px 20px 20px;
        }
    }
</style>

<style>
    /* Logo Carousel Animation */
    @keyframes scrollLogos {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    .logo-carousel-wrapper:hover .logo-carousel {
        animation-play-state: paused;
    }
    
    .logo-item {
        flex-shrink: 0;
    }
    
    .logo-box {
        width: 120px;
        height: 120px;
        background: white;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }
    
    .logo-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(235, 10, 30, 0.15);
        border-color: #eb0a1e;
    }
    
    .logo-box img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
    }
    
    .logo-box span {
        font-size: 0.75rem;
        font-weight: 600;
        color: #333;
    }
    
    .stat-item {
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
    }
    
    @media (max-width: 768px) {
        .partners-stats {
            gap: 30px !important;
        }
        .partners-stats .stat-item > div:first-child {
            font-size: 2.2rem !important;
        }
        .logo-box {
            width: 100px;
            height: 100px;
        }
        .logo-box img {
            width: 50px;
            height: 50px;
        }
    }

    /* Contact Section Styles */
    .contact-card {
        background: white;
        padding: 25px 20px;
        text-align: center;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        border-radius: 8px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid #f8f9fa;
    }
    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.08);
        border-color: #eb0a1e;
    }
    .contact-icon-box {
        width: 45px;
        height: 45px;
        border: 1.5px dotted #eb0a1e;
        color: #eb0a1e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        transition: all 0.3s ease;
    }
    .contact-card:hover .contact-icon-box {
        background: #eb0a1e;
        color: white;
        border-style: solid;
    }
    .contact-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #333;
    }
    .contact-card p {
        font-size: 0.82rem;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }
    #contact input:focus, #contact textarea:focus {
        border-color: #eb0a1e !important;
        outline: none;
        box-shadow: 0 0 10px rgba(235, 10, 30, 0.05);
    }
    #contact button:hover {
        background: #fff !important;
        color: #eb0a1e !important;
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(235, 10, 30, 0.15) !important;
    }

    @media (max-width: 991px) {
        #contact {
            padding: 40px 15px 50px 15px !important;
        }
        #contact .scroll-animate-up h2 {
            font-size: 1.8rem !important;
        }
        #contact > div > div:first-child {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }
        #contact > div > div:last-child {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }
        .contact-form-container {
            height: auto !important;
            padding: 25px 15px !important;
        }
    }

    @media (max-width: 768px) {
        .contact-card {
            padding: 20px 15px;
        }
        .contact-card h3 {
            font-size: 1rem;
        }
    }
</style>

<script>
    // Drag to scroll functionality
    const partnersContainer = document.getElementById('partnersContainer');
    let isDown = false;
    let startX;
    let scrollLeft;

    partnersContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        partnersContainer.style.cursor = 'grabbing';
        startX = e.pageX - partnersContainer.offsetLeft;
        scrollLeft = partnersContainer.scrollLeft;
    });

    partnersContainer.addEventListener('mouseleave', () => {
        isDown = false;
        partnersContainer.style.cursor = 'grab';
    });

    partnersContainer.addEventListener('mouseup', () => {
        isDown = false;
        partnersContainer.style.cursor = 'grab';
    });

    partnersContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - partnersContainer.offsetLeft;
        const walk = (x - startX) * 2;
        partnersContainer.scrollLeft = scrollLeft - walk;
    });

    // Touch support for mobile
    partnersContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].pageX - partnersContainer.offsetLeft;
        scrollLeft = partnersContainer.scrollLeft;
    });

    partnersContainer.addEventListener('touchmove', (e) => {
        const x = e.touches[0].pageX - partnersContainer.offsetLeft;
        const walk = (x - startX) * 2;
        partnersContainer.scrollLeft = scrollLeft - walk;
    });
</script>


<style>
    .product-tab-v2 { border-bottom: 3px solid transparent !important; }
    .product-tab-v2:hover { color: #333 !important; }
    .product-tab-v2.active { color: #333 !important; border-bottom: 3px solid #eb0a1e !important; }
    .product-card-v2 { cursor: pointer; }
    .product-card-v2:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-color: #ccc; transform: translateY(-3px); }
    @media (max-width: 968px) {
        .product-content-v2 { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 640px) {
        .product-content-v2 { grid-template-columns: 1fr !important; }
        .product-tab-v2 { padding: 12px 20px !important; font-size: 0.9rem !important; }
    }
    
    /* Product Modal Styles */
    .product-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .product-modal-overlay.show {
        display: flex;
        opacity: 1;
    }
    .product-modal {
        background: white;
        border-radius: 16px;
        max-width: 700px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }
    .product-modal-overlay.show .product-modal {
        transform: scale(1);
    }
    .product-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        background: #f5f5f5;
        border: none;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: all 0.3s ease;
    }
    .product-modal-close:hover {
        background: #eb0a1e;
        color: white;
    }
    .product-modal-image {
        width: 100%;
        height: 300px;
        background: linear-gradient(180deg, #f8f8f8 0%, #fff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }
    .product-modal-image img {
        max-width: 100%;
        max-height: 240px;
        object-fit: contain;
    }
    .product-modal-content {
        padding: 30px;
    }
    .product-modal-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #333;
        margin: 0 0 10px 0;
    }
    .product-modal-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #eb0a1e;
        margin: 0 0 20px 0;
    }
    .product-modal-section {
        margin-bottom: 20px;
    }
    .product-modal-section h4 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #333;
        margin: 0 0 10px 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .product-modal-section p {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.7;
        margin: 0;
    }
    .product-modal-features {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }
    .product-modal-features span {
        background: #f5f5f5;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #333;
    }
    .product-modal-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 14px 35px;
        background: linear-gradient(135deg, #eb0a1e 0%, #c00818 100%);
        color: white;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        border-radius: 30px;
        transition: all 0.3s ease;
    }
    .product-modal-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(235,10,30,0.3);
        color: white;
    }
</style>

<!-- Product Modal Popup -->
<div class="product-modal-overlay" id="productModal">
    <div class="product-modal">
        <button class="product-modal-close" onclick="closeProductModal()">×</button>
        <div class="product-modal-image">
            <img id="modalProductImage" src="" alt="Product">
        </div>
        <div class="product-modal-content">
            <h3 class="product-modal-title" id="modalProductTitle"></h3>
            <p class="product-modal-price" id="modalProductPrice"></p>
            
            <div class="product-modal-section">
                <h4>Deskripsi Produk</h4>
                <p id="modalProductDesc"></p>
            </div>
            
            <div class="product-modal-section">
                <h4>Kegunaan</h4>
                <p id="modalProductUsage"></p>
            </div>
            
            <div class="product-modal-section">
                <h4>Fitur Unggulan</h4>
                <div class="product-modal-features" id="modalProductFeatures"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Product data
    const productData = {
        'Rare Cushion Unit': {
            image: '{{ asset("assets/img/2wrarecushion.png") }}',
            price: 'Rp350.000',
            desc: 'Shock absorber premium dengan teknologi twin-tube yang memberikan kenyamanan berkendara optimal. Dirancang khusus untuk motor matic dan sport.',
            usage: 'Cocok untuk penggunaan harian di jalanan kota maupun luar kota. Memberikan stabilitas ekstra saat menikung dan pengereman.',
            features: ['Twin-Tube Technology', 'Anti-Corrosion', 'Premium Oil', 'Long Lasting']
        },
        'Front Frok': {
            image: '{{ asset("assets/img/2wfrontfrok.png") }}',
            price: 'Rp420.000',
            desc: 'Seri Ultra dengan performa tinggi untuk motor bebek. Menggunakan material berkualitas tinggi untuk ketahanan maksimal.',
            usage: 'Ideal untuk motor bebek yang digunakan sehari-hari. Memberikan kestabilan saat membawa beban berat.',
            features: ['Heavy Duty', 'Smooth Ride', 'Durable', 'Easy Install']
        },
        'KYB Trail Master': {
            image: '{{ asset("assets/img/premium.png") }}',
            price: 'Rp550.000',
            desc: 'Shock absorber khusus untuk motor trail dengan kemampuan off-road yang luar biasa. Dirancang untuk medan berat.',
            usage: 'Sempurna untuk adventure dan off-road riding. Mampu menyerap guncangan keras di medan berbatu.',
            features: ['Off-Road Ready', 'Extra Stroke', 'Mud Resistant', 'High Performance']
        },
        'KYB Economy': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp280.000',
            desc: 'Solusi ekonomis dengan kualitas KYB yang terjamin. Pilihan tepat untuk penggantian rutin.',
            usage: 'Cocok untuk penggunaan standar sehari-hari dengan budget terbatas namun tetap ingin kualitas KYB.',
            features: ['Affordable', 'Reliable', 'OEM Quality', 'Value for Money']
        },
        'KYB Heavy Duty': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp620.000',
            desc: 'Heavy duty series untuk beban ekstra berat. Konstruksi kokoh dengan material pilihan.',
            usage: 'Ideal untuk motor yang sering membawa beban berat atau penumpang ganda.',
            features: ['Extra Strong', 'Load Capacity+', 'Commercial Grade', 'Extended Life']
        },
        'KYB Excel-G': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp850.000',
            desc: 'Seri Excel-G adalah shock absorber gas nitrogen premium untuk mobil SUV dan MPV. Teknologi restore original handling.',
            usage: 'Mengembalikan performa handling seperti baru untuk mobil keluarga. Cocok untuk perjalanan jauh.',
            features: ['Gas Nitrogen', 'OE Restore', 'All Weather', 'Family Safe']
        },
        'KYB Gas-A-Just': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp720.000',
            desc: 'Gas-A-Just monotube shock absorber untuk city car. Respons lebih cepat dibanding twin-tube.',
            usage: 'Perfect untuk city driving dengan banyak stop-and-go. Memberikan kontrol lebih baik di tikungan tajam.',
            features: ['Monotube Design', 'Quick Response', 'City Optimized', 'Compact Size']
        },
        'KYB MonoMax': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp950.000',
            desc: 'MonoMax adalah shock absorber heavy-duty untuk pick up dan truck ringan. Kapasitas beban maksimal.',
            usage: 'Dirancang untuk kendaraan komersial yang sering mengangkut barang berat.',
            features: ['Max Load', 'Commercial Use', 'Extra Durable', 'Work Horse']
        },
        'KYB Fork Suspension': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp1.200.000',
            desc: 'Fork suspension untuk sepeda gunung (MTB) dengan travel panjang. Teknologi air-spring adjustable.',
            usage: 'Untuk trail riding dan downhill. Dapat disesuaikan dengan berat rider dan kondisi track.',
            features: ['Air Spring', 'Adjustable', 'Trail Ready', 'Lightweight']
        },
        'KYB E-Bike Shock': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp980.000',
            desc: 'Shock absorber khusus e-bike dengan penyesuaian beban baterai. Smooth ride untuk sepeda listrik.',
            usage: 'Optimal untuk e-bike dengan berbagai konfigurasi baterai. Menyerap getaran motor listrik.',
            features: ['E-Bike Optimized', 'Battery Weight Ready', 'Smooth Control', 'Silent']
        },
        'KYB Road Series': {
            image: '{{ asset("assets/img/kyb1.png") }}',
            price: 'Rp750.000',
            desc: 'Road Series untuk sepeda jalan raya dengan fokus pada efisiensi dan kenyamanan jarak jauh.',
            usage: 'Ideal untuk road cycling dan commuting. Ringan dan efisien untuk perjalanan jauh.',
            features: ['Road Optimized', 'Lightweight', 'Efficient', 'Long Distance']
        }
    };

    // Tab functionality
    document.querySelectorAll('.product-tab-v2').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.product-tab-v2').forEach(t => {
                t.classList.remove('active');
                t.style.color = '#888';
            });
            this.classList.add('active');
            this.style.color = '#333';
            document.querySelectorAll('.product-content-v2').forEach(content => { content.style.display = 'none'; });
            const tabId = this.getAttribute('data-tab');
            const targetContent = document.getElementById('tab-v2-' + tabId);
            if (targetContent) { targetContent.style.display = 'grid'; }
        });
    });

    // Product card click functionality
    document.querySelectorAll('.product-card-v2').forEach(card => {
        card.addEventListener('click', function() {
            const title = this.querySelector('h3').textContent;
            const product = productData[title];
            
            if (product) {
                document.getElementById('modalProductImage').src = product.image;
                document.getElementById('modalProductTitle').textContent = title;
                document.getElementById('modalProductPrice').textContent = product.price;
                document.getElementById('modalProductDesc').textContent = product.desc;
                document.getElementById('modalProductUsage').textContent = product.usage;
                
                const featuresContainer = document.getElementById('modalProductFeatures');
                featuresContainer.innerHTML = '';
                product.features.forEach(feature => {
                    const span = document.createElement('span');
                    span.textContent = feature;
                    featuresContainer.appendChild(span);
                });
                
                document.getElementById('productModal').classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // Close modal
    function closeProductModal() {
        document.getElementById('productModal').classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    // Close on overlay click
    document.getElementById('productModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeProductModal();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeProductModal();
        }
    });
</script>

<style>
    .visi-misi-box:hover {
        transform: translateX(8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.08) !important;
        background: #fff !important;
        border-left-color: #c00818 !important;
    }
    
    @media (max-width: 968px) {
        .vision-mission-grid {
            grid-template-columns: 1fr !important;
            gap: 30px !important;
        }
        
        #vision-mission h2 {
            font-size: 1.6rem !important;
        }
        
        #vision-mission img {
            height: 300px !important;
        }
        
        .vm-image {
            margin-top: 0 !important;
        }
    }
    
    @media (max-width: 640px) {
        #vision-mission {
            padding: 40px 15px 50px 15px !important;
        }
        
        #vision-mission h2 {
            font-size: 1.4rem !important;
        }
        
        .visi-misi-box {
            padding: 16px !important;
        }
        
        #vision-mission img {
            height: 250px !important;
        }
    }
</style>

<style>
    html {
        scroll-behavior: smooth;
    }
    
    /* Scroll Animations */
    .scroll-animate-left {
        opacity: 0;
        transform: translateX(-100px);
        transition: all 0.8s ease-out;
    }
    
    .scroll-animate-right {
        opacity: 0;
        transform: translateX(100px);
        transition: all 0.8s ease-out;
    }
    
    .scroll-animate-left.active,
    .scroll-animate-right.active {
        opacity: 1;
        transform: translateX(0);
    }
    
    #about div[style*="border: 2px solid"]:hover {
        border-color: #eb0a1e;
        box-shadow: 0 5px 15px rgba(235, 10, 30, 0.1);
        transform: translateY(-3px);
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(0,0,0,0.3);
    }
    
    @media (max-width: 968px) {
        #about > div > div {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }
        
        #about img {
            height: 350px !important;
        }
        
        #about h2 {
            font-size: 1.5rem !important;
        }
        
        #about p {
            font-size: 0.8rem !important;
        }
        
        #vision-mission > div > div {
            grid-template-columns: 1fr !important;
            gap: 30px !important;
        }
        
        #vision-mission h2 {
            font-size: 1.6rem !important;
        }
        
        #vision-mission h3 {
            font-size: 1.3rem !important;
        }
        
        #statistics > div > div {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    
    @media (max-width: 640px) {
        #about {
            padding: 60px 15px !important;
        }
        
        #about > div > div {
            gap: 30px !important;
        }
        
        #about img {
            height: 250px !important;
        }
        
        #about h2 {
            font-size: 1.3rem !important;
        }
        
        #about p {
            font-size: 0.75rem !important;
        }
        
        #about div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
        
        #statistics > div > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>

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
    
    // Scroll Animation Observer
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);
    
    // Observe all scroll-animate elements
    document.querySelectorAll('.scroll-animate-left, .scroll-animate-right').forEach(el => {
        observer.observe(el);
    });
</script>
@endsection