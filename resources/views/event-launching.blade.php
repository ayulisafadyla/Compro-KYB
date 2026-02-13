
@extends('layouts.app')

@section('content')
<style>
    main {
        margin-top: 0 !important;
    }
    
    /* Hero Section - Event Launching */
    .event-hero {
        position: relative;
        width: 100vw;
        height: 60vh;
        margin-left: calc(-50vw + 50%);
        background: linear-gradient(135deg, #eb0a1e 0%, #c00818 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .event-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('{{ asset('assets/img/perusahaann.jpg') }}') center/cover;
        opacity: 0.15;
    }
    
    .event-hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        color: white;
        max-width: 900px;
        padding: 0 20px;
    }
    
    .event-hero-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    
    .event-hero-title {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 15px;
        text-shadow: 3px 3px 20px rgba(0,0,0,0.5);
    }
    
    .event-hero-subtitle {
        font-size: 1.2rem;
        font-weight: 300;
        opacity: 0.95;
        margin-bottom: 30px;
    }
    
    .event-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    /* Event List Section */
    .event-list-section {
        padding: 80px 20px;
        background: white;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 900;
        color: #333;
        margin-bottom: 10px;
    }
    
    .section-subtitle {
        font-size: 1rem;
        color: #666;
    }
    
    /* Event Card */
    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .event-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 40px rgba(235, 10, 30, 0.2);
    }
    
    .event-card-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: linear-gradient(135deg, #eb0a1e 0%, #ff4757 100%);
    }
    
    .event-card-content {
        padding: 25px;
    }
    
    .event-card-date {
        display: inline-block;
        background: #fff5f5;
        color: #eb0a1e;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .event-card-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #333;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    
    .event-card-desc {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .event-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
    }
    
    .event-card-location {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: #888;
    }
    
    .event-card-btn {
        background: #eb0a1e;
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .event-card-btn:hover {
        background: #c00818;
        color: white;
        transform: scale(1.05);
    }
    
    @media (max-width: 768px) {
        .event-hero-title {
            font-size: 2rem;
        }
        .event-hero-subtitle {
            font-size: 1rem;
        }
        .event-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<div class="event-hero">
    <div class="event-hero-content">
        <div class="event-hero-icon">
        </div>
        <h1 class="event-hero-title">Acara Peluncuran Produk</h1>
        <p class="event-hero-subtitle">Temukan produk terbaru dari PT Kayaba Indonesia dengan teknologi suspensi terkini</p>
    </div>
</div>

<!-- Event List Section -->
<section class="event-list-section">
    <div class="section-header">
        <h2 class="section-title">Peluncuran Terbaru</h2>
        <p class="section-subtitle">Jangan lewatkan peluncuran produk-produk inovatif kami</p>
    </div>
    
    <div class="event-grid">
        <!-- Event Card 1 -->
        <div class="event-card">
            <img src="{{ asset('assets/img/kyb1.png') }}" alt="Event" class="event-card-image">
            <div class="event-card-content">
                <span class="event-card-date">
                    <i class="bi bi-calendar3 me-1"></i>15 Maret 2026
                </span>
                <h3 class="event-card-title">Launching KYB Ultra Series 2026</h3>
                <p class="event-card-desc">Peluncuran produk shock absorber terbaru dengan teknologi gas-charged untuk performa maksimal kendaraan Anda.</p>
                <div class="event-card-footer">
                    <div class="event-card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jakarta Convention Center</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Card 2 -->
        <div class="event-card">
            <img src="{{ asset('assets/img/kyb1.png') }}" alt="Event" class="event-card-image">
            <div class="event-card-content">
                <span class="event-card-date">
                    <i class="bi bi-calendar3 me-1"></i>22 Maret 2026
                </span>
                <h3 class="event-card-title">Launching KYB Sport Edition</h3>
                <p class="event-card-desc">Produk khusus untuk motor sport dengan handling superior dan stabilitas tinggi di kecepatan tinggi.</p>
                <div class="event-card-footer">
                    <div class="event-card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Surabaya Expo Center</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Card 3 -->
        <div class="event-card">
            <img src="{{ asset('assets/img/kyb1.png') }}" alt="Event" class="event-card-image">
            <div class="event-card-content">
                <span class="event-card-date">
                    <i class="bi bi-calendar3 me-1"></i>5 April 2026
                </span>
                <h3 class="event-card-title">Launching KYB Excel-G Premium</h3>
                <p class="event-card-desc">Shock absorber premium untuk mobil keluarga dengan kenyamanan berkendara yang luar biasa.</p>
                <div class="event-card-footer">
                    <div class="event-card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Bandung Trade Center</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Card 4 -->
        <div class="event-card">
            <img src="{{ asset('assets/img/kyb1.png') }}" alt="Event" class="event-card-image">
            <div class="event-card-content">
                <span class="event-card-date">
                    <i class="bi bi-calendar3 me-1"></i>18 April 2026
                </span>
                <h3 class="event-card-title">Launching KYB Heavy Duty Series</h3>
                <p class="event-card-desc">Solusi suspensi untuk kendaraan komersial dan truk dengan daya tahan ekstra untuk beban berat.</p>
                <div class="event-card-footer">
                    <div class="event-card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Medan International Expo</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Card 5 -->
        <div class="event-card">
            <img src="{{ asset('assets/img/kyb1.png') }}" alt="Event" class="event-card-image">
            <div class="event-card-content">
                <span class="event-card-date">
                    <i class="bi bi-calendar3 me-1"></i>10 Mei 2026
                </span>
                <h3 class="event-card-title">Launching KYB E-Bike Suspension</h3>
                <p class="event-card-desc">Inovasi terbaru untuk sepeda listrik dengan teknologi suspensi yang ringan dan efisien.</p>
                <div class="event-card-footer">
                    <div class="event-card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Bali Nusa Dua Convention</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Card 6 -->
        <div class="event-card">
            <img src="{{ asset('assets/img/kyb1.png') }}" alt="Event" class="event-card-image">
            <div class="event-card-content">
                <span class="event-card-date">
                    <i class="bi bi-calendar3 me-1"></i>25 Mei 2026
                </span>
                <h3 class="event-card-title">Launching KYB MonoMax 4x4</h3>
                <p class="event-card-desc">Shock absorber khusus untuk kendaraan off-road dengan performa terbaik di medan ekstrem.</p>
                <div class="event-card-footer">
                    <div class="event-card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Makassar Convention Hall</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
