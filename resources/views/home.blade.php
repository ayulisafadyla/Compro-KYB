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

    @keyframes scroll-left {
        0% { transform: translateX(0); }
        100% { transform: translateX(-5%); }
    }

    .carousel-track {
        display: flex;
        gap: 20px;
        /* Speed: 10s for 1 set width. Adjust as needed. */
        animation: scroll-left 10s linear infinite;
        width: fit-content;
        will-change: transform;
    }

    .carousel-track:hover {
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
        flex: 0 0 auto;
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
            display: flex;
            gap: 20px;
            animation: scroll 20s linear infinite;
            animation-name: step-pause-scroll-mobile;
        }
    }

    .support-wrapper {
        position: relative;
        padding-top: 30px; /* Reduced from 180px */
        cursor: pointer;
    }

    .support-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        z-index: 10;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .support-img {
        width: 80px;
        height: auto;
        margin-bottom: 0px;
        opacity: 0.1; /* Placeholder styling */
        position: absolute;
    }

    .support-icon {
        font-size: 3rem;
        color: #333;
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .support-wrapper:hover .support-card {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .support-wrapper:hover .support-icon {
        color: #eb0a1e;
        transform: scale(1.1);
    }

    /* Red Bubble Tooltip */
    .support-bubble {
        position: absolute;
        bottom: 210px; /* Position above the card */
        left: 50%;
        transform: translateX(-50%) scale(0.8);
        width: 280px;
        background: linear-gradient(135deg, #ff4d4d 0%, #eb0a1e 100%);
        color: white;
        padding: 25px;
        border-radius: 20px;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 20;
        box-shadow: 0 10px 25px rgba(235, 10, 30, 0.3);
        pointer-events: none;
    }

    .support-bubble h5 {
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .support-bubble p {
        font-size: 0.85rem;
        line-height: 1.5;
        margin: 0;
        opacity: 0.95;
    }

    /* Bubble Arrow */
    .bubble-arrow {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-top: 15px solid #eb0a1e;
    }

    /* Hover State showing bubble */
    .support-wrapper:hover .support-bubble {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) scale(1) translateY(-10px);
    }

    .icon-box-gold {
        width: 50px;
        height: 50px;
        background-color: #eb0a1e; /* Gold */
        color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 1.25rem;
        border-radius: 4px;
    }

    .form-control-clean {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        padding: 15px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .form-control-clean:focus {
        border-color: #eb0a1e;
        box-shadow: none;
    }

    .btn-gold {
        background-color: #eb0a1e;
        color: #000;
        border: none;
        border-radius: 4px;
        transition: all 0.3s;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .btn-gold:hover {
        background-color: #e0a800;
        color: #fff;
    }

    /* Animation Delays */
    .delay-100 { transition-delay: 0.1s; }
    .delay-200 { transition-delay: 0.2s; }

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

<div class="hero-carousel">
    @forelse($heroBanners as $index => $banner)
    <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            @if($banner->subtitle)
            <p class="carousel-subtitle">{{ $banner->subtitle }}</p>
            @endif
            @if($banner->title)
            <h1 class="carousel-title">{!! nl2br(e($banner->title)) !!}</h1>
            @endif
            @if($banner->description)
            <p class="carousel-description">{{ $banner->description }}</p>
            @endif
            @if($banner->link)
            <a href="{{ $banner->link }}" class="carousel-btn">{{ $banner->button_text ?? 'Hubungi Kami' }}</a>
            @endif
        </div>
    </div>
    @empty
    {{-- Fallback slide jika belum ada banner di database --}}
    <div class="carousel-slide active" style="background-image: url('{{ asset('assets/img/kyb1.png') }}');">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <p class="carousel-subtitle">SOLUSI UNTUK SEMUA JENIS KENDARAAN</p>
            <h1 class="carousel-title">Sistem Suspensi<br>Dimulai Dari Sini!</h1>
            <p class="carousel-description">PT Kayaba Indonesia menghadirkan teknologi suspensi terkemuka dengan standar kualitas internasional</p>
            <a href="#products" class="carousel-btn">Jelajahi Produk</a>
        </div>
    </div>
    @endforelse

    @if($heroBanners->count() > 1)
    <!-- Navigation Buttons MERAH -->
    <button class="carousel-nav prev" onclick="changeSlide(-1)">
        ◀
    </button>
    <button class="carousel-nav next" onclick="changeSlide(1)">
        ▶
    </button>

    <!-- Indicators -->
    <div class="custom-carousel-indicators">
        @foreach($heroBanners as $index => $banner)
        <span class="indicator {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></span>
        @endforeach
    </div>
    @endif
</div>


<!-- About Us Section - Dynamic 3-Column Layout -->
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
            @php $sejarah = $homeAbouts->where('type', 'sejarah')->first(); @endphp
            <div class="scroll-animate-right" style="text-align: right;">
                <h3 style="font-size: 1.5rem; font-weight: 500; color: #333; margin: 0 0 15px 0; letter-spacing: 2px;">{{ $sejarah ? strtoupper($sejarah->title) : 'SEJARAH PERUSAHAAN' }}</h3>
                <div style="color: #666; line-height: 1.8; font-size: 0.95rem; margin-bottom: 0;">
                    {!! $sejarah ? $sejarah->content : 'PT Kayaba Indonesia didirikan pada 25 Februari 1976 dengan nama awal PT Kayaba Jepang kemudian menjalin kerja sama dengan PT Astra Otoparts Tbk. dan berkembang menjadi PT Kayaba Indonesia.' !!}
                </div>
            </div>

            <!-- Center Column: Image -->
            <div class="scroll-animate-up" style="position: relative; display: flex; justify-content: center;">
                 <!-- Image Container - Smaller & No Frame -->
                 <div style="position: relative; width: 100%; max-width: 320px; margin: 0 auto;">

                    <!-- Main Image Container -->
                    <div style="position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 2;">
                        @if($aboutImage && $aboutImage->image)
                            <img src="{{ asset('storage/' . $aboutImage->image) }}" alt="PT Kayaba Indonesia" style="width: 100%; height: 350px; object-fit: cover; display: block;">
                        @else
                            <img src="{{ asset('assets/img/kyb2.jpeg') }}" alt="PT Kayaba Indonesia" style="width: 100%; height: 350px; object-fit: cover; display: block;">
                        @endif

                        <!-- Overlay Gradient (Softer) -->
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100px; background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 100%);"></div>

                    </div>
                </div>
            </div>

            <!-- Right Column: VISI & MISI -->
            @php $visiMisi = $homeAbouts->where('type', 'visi-misi')->first(); @endphp
            <div class="scroll-animate-left" style="text-align: left;">
                <h3 style="font-size: 1.5rem; font-weight: 500; color: #333; margin: 0 0 15px 0; letter-spacing: 2px;">{{ $visiMisi ? strtoupper($visiMisi->title) : 'VISI & MISI' }}</h3>
                <div style="color: #666; line-height: 1.8; font-size: 0.95rem;">
                    {!! $visiMisi ? $visiMisi->content : '<p style="margin-bottom: 15px;"><strong>Visi PT Kayaba Indonesia</strong><br>"To be world wide shock absorber production base for KYB group".</p><p style="margin: 0;"><strong>Misi PT Kayaba Indonesia</strong><br>1. To be Number One in Cost and Quality for Two Wheelers in Shock Absorber in the World.<br>2. To Implement Astra Green Company, Astra Friendly Company, Security Community Dev &amp; IR Management System, and KIPKA.</p>' !!}
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Video Banner Section -->
<section id="video-banner" style="position: relative; padding: 100px 20px; text-align: center; color: white; overflow: hidden;">
    <!-- Parallax Background -->
    @if($homeVideo && $homeVideo->background_image)
    <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 100vw; height: 100%; background-image: url('{{ asset('storage/' . $homeVideo->background_image) }}'); background-size: cover; background-position: center; z-index: 0;"></div>
    @else
    <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 100vw; height: 100%; background-image: url('{{ asset('assets/img/kyb3.png') }}'); background-size: cover; background-position: center; z-index: 0;"></div>
    @endif

    <!-- Dark Overlay -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1;"></div>

    <!-- Content Container -->
    <div class="video-content" style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; gap: 60px;">

        <!-- Left Text: WATCH OUR VIDEO -->
        <div class="video-text-left scroll-animate-left" style="text-align: right; flex: 1;">
            <h2 style="font-size: 1.5rem; font-weight: 400; margin: 0; letter-spacing: 2px; line-height: 1;">
                @if($homeVideo && $homeVideo->title)
                    {!! nl2br(e($homeVideo->title)) !!}
                @else
                    TONTON VIDEO <br> KAMI
                @endif
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
                @if($homeVideo && $homeVideo->subtitle)
                    {!! nl2br(e($homeVideo->subtitle)) !!}
                @else
                    Presisi Kami<br>Keuntungan Anda
                @endif
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
                    <a href="{{ $homeVideo ? $homeVideo->video_url : 'https://www.youtube.com/watch?v=2h5unVOZvL4' }}" target="_blank" onclick="var myModalEl = document.getElementById('videoConfirmationModal'); var modal = bootstrap.Modal.getInstance(myModalEl); modal.hide();" class="btn" style="background: #eb0a1e; color: white; border: none; padding: 12px 35px; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 15px rgba(235, 10, 30, 0.3); transition: 0.3s;">Ya</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Philosophy Modal -->
<div class="philosophy-modal-overlay" id="philosophyModal">
    <div class="philosophy-modal">
        <button class="philosophy-modal-close" onclick="closePhilosophyModal()">×</button>

        <div class="philosophy-modal-header">
            <h2>Filosofi Perusahaan</h2>
            <p>Prinsip dan nilai-nilai yang menjadi landasan PT Kayaba Indonesia</p>
        </div>

        <div class="philosophy-modal-content">
            @if($homePhilosophies->count() > 0)
                @php $firstPhil = $homePhilosophies->first(); @endphp
                @if($firstPhil->content)
                <!-- Philosophy Quote from first item -->
                <p class="philosophy-quote">
                    {!! strip_tags($firstPhil->content) !!}
                </p>
                @endif

                <!-- Core Values with Icons -->
                <div class="philosophy-values-simple">
                    @foreach($homePhilosophies as $phil)
                    <div class="philosophy-value-simple">
                        <div class="icon-circle">
                            @if($phil->icon)
                                <i class="{{ $phil->icon }}" style="font-size: 24px; color: #eb0a1e;"></i>
                            @else
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#eb0a1e" stroke-width="2">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            @endif
                        </div>
                        <span>{{ $phil->title }}</span>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback static content -->
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
            @endif
        </div>
    </div>
</div>

<!-- Products Section - Dynamic -->
<section id="products" style="padding: 60px 20px 40px 20px; background: white; position: relative;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Section Header -->
        <div class="scroll-animate-up" style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-size: 2rem; font-weight: 500; color: #eb0a1e; margin: 0; letter-spacing: 2px;">JELAJAHI PRODUK</h2>
            <p style="color: #666; font-size: 0.7rem; margin: 10px 0 0 0; letter-spacing: 1px; text-transform: uppercase;">KUALITAS OEM &amp; OES TERBAIK</p>
            <div style="width: 60px; height: 1px; background: #666; margin: 20px auto 0;"></div>
        </div>

        @if($categories->count() > 0)
        <!-- Tab Navigation - Dynamic from DB -->
        <div style="display: flex; justify-content: center; border-bottom: 1px solid #e0e0e0; margin-bottom: 25px;">
            @foreach($categories as $index => $category)
            <button class="product-tab-v2 {{ $index === 0 ? 'active' : '' }}"
                    data-tab="{{ $category->slug }}"
                    style="padding: 15px 40px; background: none; border: none; font-size: 1rem; font-weight: 600; color: {{ $index === 0 ? '#333' : '#888' }}; cursor: pointer; position: relative; transition: all 0.3s ease;">
                {{ $category->name }}
            </button>
            @endforeach
        </div>

        <!-- Product Grids - Dynamic from DB -->
        @foreach($categories as $index => $category)
        <div class="product-content-v2 {{ $index === 0 ? 'scroll-animate-up' : '' }}"
             id="tab-v2-{{ $category->slug }}"
             style="display: {{ $index === 0 ? 'grid' : 'none' }}; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @forelse($category->products->where('is_active', true) as $product)
            <div style="background: white; border: 1px solid #e8e8e8; border-radius: 8px; padding: 25px 20px; position: relative; transition: all 0.3s ease; text-align: center;" class="product-card-v2" data-product-id="{{ $product->id }}">
                <div style="margin-bottom: 20px; display: flex; justify-content: center;">
                    <div style="width: 160px;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 120px; object-fit: contain;">
                        @else
                            <div style="width: 100%; height: 120px; background: #f5f5f5; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                <i class="bi bi-box" style="font-size: 2rem; color: #ccc;"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 0; line-height: 1.3;">{{ $product->name }}</h3>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
                <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                Belum ada produk di kategori ini.
            </div>
            @endforelse
        </div>
        @endforeach

        @else
        <!-- Fallback if no categories in DB -->
        <div style="text-align: center; padding: 60px 20px; color: #999;">
            <i class="bi bi-box" style="font-size: 3rem; display: block; margin-bottom: 15px;"></i>
            <p>Produk belum tersedia. Tambahkan produk melalui Admin Panel.</p>
        </div>
        @endif

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
                @if($brands->count() > 0)
                    @for($i = 0; $i < 20; $i++)
                        @foreach($brands as $brand)
                        <div class="partner-card">
                            @if($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}">
                            @else
                                <span style="font-weight: 700; font-size: 0.9rem; color: #333;">{{ $brand->name }}</span>
                            @endif
                        </div>
                        @endforeach
                    @endfor
                @else
                    {{-- Fallback static logos duplicated 20 times --}}
                    @php $logos = ['logoyamaha.png', 'logohonda.jpg', 'logoastra.jpg', 'logotoyota.jpg']; @endphp
                    @for ($k = 0; $k < 20; $k++)
                        @for ($j = 0; $j < 4; $j++)
                        <div class="partner-card">
                            <img src="{{ asset('assets/img/' . $logos[$j]) }}" alt="Partner Logo">
                        </div>
                        @endfor
                    @endfor
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Support Section (Redesigned) -->
<section id="support" style="padding: 100px 20px; background: white; position: relative;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Section Header -->
        <div class="scroll-animate-up" style="text-align: center; margin-bottom: 60px;">
             <h2 style="font-size: 2rem; font-weight: 500; color: #eb0a1e; margin: 0; letter-spacing: 2px;">PERTANYAAN UMUM (FAQ)</h2>
             <p style="color: #666; font-size: 0.7rem; margin: 10px 0 0 0; letter-spacing: 1px; text-transform: uppercase;">INFORMASI PENTING UNTUK MEMAHAMI KYB</p>
             <div style="width: 60px; height: 1px; background: #666; margin: 20px auto 0;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @php
                $faqDelays = ['delay-100','delay-200','delay-300','delay-100','delay-200','delay-300'];
            @endphp
            @forelse($faqs as $index => $faq)
            <div class="col-lg-3 col-md-6 scroll-animate-up {{ $faqDelays[$index % count($faqDelays)] }}">
                <div class="support-wrapper">
                    <!-- Red Bubble (Tooltip) -->
                    <div class="support-bubble">
                        <h5>{{ $faq->question }}</h5>
                        <p>{{ strip_tags($faq->answer) }}</p>
                        <div class="bubble-arrow"></div>
                    </div>
                    <!-- Card -->
                    <div class="support-card">
                        <div class="support-icon">
                            @php
                                $faqIcon = $faq->icon ?? 'bi-patch-question-fill';
                                // Normalize: ensure it starts with 'bi-'
                                if (!str_starts_with($faqIcon, 'bi-')) {
                                    $faqIcon = 'bi-' . ltrim($faqIcon, '-');
                                }
                            @endphp
                            <i class="bi {{ $faqIcon }}"></i>
                        </div>
                        <h6 style="margin-top: 15px; font-weight: 700; color: #333; font-size: 0.9rem;">{{ \Illuminate\Support\Str::limit(strip_tags($faq->question), 30) }}</h6>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" style="color: #999;">
                <i class="bi bi-patch-question" style="font-size: 3rem; display: block; margin-bottom: 15px;"></i>
                <p>Belum ada FAQ. Tambahkan melalui Admin Panel → Pusat Dukungan → FAQ.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" style="padding: 60px 20px 80px; background: white; position: relative;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Section Header -->
        <div class="scroll-animate-up" style="margin-bottom: 40px; text-align: left;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                 <div style="width: 30px; height: 2px; background: #eb0a1e;"></div>
                 <h6 style="color: #eb0a1e; font-weight: 700; margin: 0; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem;">Contact</h6>
            </div>
            <h2 style="font-size: 2.5rem; font-weight: 800; color: #000; margin: 0;">CONTACT US</h2>
        </div>

        <!-- Google Map (Top) -->
        <div class="scroll-animate-up" style="width: 100%; height: 350px; background: #eee; margin-bottom: 50px; border-radius: 0;">
             <iframe src="https://maps.google.com/maps?q=Kayaba%20Indonesia%20Pt.,%20Jl.%20Jawa%20No.4,%20Blok%20ii,%20Jatiwangi,%20Cikarang%20Barat&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="row g-5 align-items-stretch">
            <!-- Left Column: Contact Details -->
            <div class="col-lg-4 scroll-animate-up delay-100">
                @forelse($contactItems as $item)
                @php
                    $contactIcon = $item->icon ?? 'bi-info-circle-fill';
                    // Normalize: ensure it starts with 'bi-'
                    if (!str_starts_with($contactIcon, 'bi-') && !str_starts_with($contactIcon, 'bi ')) {
                        $contactIcon = 'bi-' . ltrim($contactIcon, '-');
                    }
                @endphp
                <div class="d-flex mb-4 align-items-start ">
                    <div class="icon-box-gold p-3 text-white">
                        <i class="bi {{ $contactIcon }}"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">{{ $item->label }}</h5>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                            {!! nl2br(e($item->value)) !!}
                        </p>
                    </div>
                </div>
                @empty
                <p class="text-muted">Belum ada kontak. Tambahkan melalui Admin Panel → Pusat Dukungan → Kontak.</p>
                @endforelse
            </div>

            <!-- Right Column: Form -->
            <div class="col-lg-8 scroll-animate-up delay-200">
                <form action="#" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-clean" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control form-control-clean" placeholder="Your Email" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control form-control-clean" placeholder="Subject" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control form-control-clean" rows="5" placeholder="Message" required></textarea>
                        </div>
                         <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-gold w-100 py-3 fw-bold text-white">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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
    // Product data - dynamically generated from database
    const productData = {
        @foreach($categories as $category)
            @foreach($category->products->where('is_active', true) as $product)
            {{ $product->id }}: {
                image: '{{ $product->image ? asset("storage/" . $product->image) : asset("assets/img/kyb1.png") }}',
                name: '{{ addslashes($product->name) }}',
                price: '{{ $product->price ? "Rp " . number_format($product->price, 0, ",", ".") : "" }}',
                desc: '{{ addslashes(strip_tags($product->description ?? "")) }}',
                usage: '{{ addslashes($product->usage ?? "") }}',
                features: {!! json_encode($product->features ?? []) !!}
            },
            @endforeach
        @endforeach
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
            const productId = this.getAttribute('data-product-id');
            const product = productData[productId];

            if (product) {
                document.getElementById('modalProductImage').src = product.image;
                document.getElementById('modalProductTitle').textContent = product.name;
                document.getElementById('modalProductDesc').textContent = product.desc;
                document.getElementById('modalProductUsage').textContent = product.usage;

                const featuresContainer = document.getElementById('modalProductFeatures');
                featuresContainer.innerHTML = '';
                (product.features || []).forEach(feature => {
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

@endsection
