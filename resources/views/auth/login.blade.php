@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="glass-card">
        <h2 class="text-center text-danger mb-2 fw-bold fs-5">Sign In</h2>
        
        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            
            <div class="mb-2 position-relative">
                <i class="bi bi-person-fill position-absolute top-50 start-0 translate-middle-y ms-3 text-danger fs-5"></i>
                <input type="text" name="username" id="username" 
                       class="form-control glass-input ps-5" 
                       placeholder="Username"
                       autocomplete="off"
                       inputmode="numeric"
                       pattern="[0-9]*"
                       required>
            </div>
            
            <div class="mb-2 position-relative">
                <i class="bi bi-lock-fill position-absolute top-50 start-0 translate-middle-y ms-3 text-danger fs-5"></i>
                <input type="password" name="password" id="password" 
                       class="form-control glass-input ps-5" 
                       placeholder="............."
                       autocomplete="new-password"
                       required>
            </div>

            <!-- CAPTCHA Section - Canvas-based Distorted Image -->
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <div class="bg-white rounded p-2 d-flex align-items-center justify-content-center w-100 me-2" style="border: 1px solid #e0e0e0;">
                    <canvas id="captcha-canvas" width="150" height="45"></canvas>
                </div>
                <button type="button" class="btn btn-warning rounded-circle shadow-sm" id="reload-captcha" style="width: 40px; height: 40px; flex-shrink: 0;">
                    <i class="bi bi-arrow-clockwise fs-6 text-white fw-bold"></i>
                </button>
            </div>

            <div class="mb-2 position-relative">
                <i class="bi bi-shield-check position-absolute top-50 start-0 translate-middle-y ms-3 text-danger fs-5"></i>
                <input type="text" name="captcha" 
                       class="form-control glass-input ps-5" 
                       placeholder="Masukkan Kode CAPTCHA" 
                       autocomplete="off"
                       required>
            </div>
            @error('captcha')
                <div class="text-danger small mb-2 text-center">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="btn btn-primary w-100 glass-btn mb-2">
                LOGIN
            </button>
        </form>
    </div>
</div>

<script>
    let captchaCode = "{{ $captchaCode ?? session('captcha_code', 'XXXXX') }}";
    
    function drawCaptcha() {
        const canvas = document.getElementById('captcha-canvas');
        const ctx = canvas.getContext('2d');
        
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Background with gradient
        const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
        gradient.addColorStop(0, '#f0f0f0');
        gradient.addColorStop(1, '#e8e8e8');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Add noise
        for (let i = 0; i < 100; i++) {
            ctx.fillStyle = `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.3)`;
            ctx.fillRect(Math.random() * canvas.width, Math.random() * canvas.height, 2, 2);
        }
        
        // Draw random lines
        for (let i = 0; i < 3; i++) {
            ctx.strokeStyle = `rgba(${Math.random() * 100}, ${Math.random() * 100}, ${Math.random() * 100}, 0.4)`;
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
            ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
            ctx.stroke();
        }
        
        // Draw captcha text with distortion
        const chars = captchaCode.split('');
        const baseX = 15;
        const baseY = 32;
        
        chars.forEach((char, index) => {
            ctx.save();
            
            // Random rotation and position
            const x = baseX + (index * 25) + (Math.random() * 8 - 4);
            const y = baseY + (Math.random() * 6 - 3);
            const rotation = (Math.random() * 0.4 - 0.2);
            
            ctx.translate(x, y);
            ctx.rotate(rotation);
            
            // Random color (darker shades)
            const colors = ['#2c3e50', '#34495e', '#7f8c8d', '#95a5a6', '#000000'];
            ctx.fillStyle = colors[Math.floor(Math.random() * colors.length)];
            
            // Random font - smaller size
            ctx.font = `bold ${24 + Math.random() * 4}px Arial`;
            ctx.fillText(char, 0, 0);
            
            ctx.restore();
        });
        
        // Add some strike-through lines
        for (let i = 0; i < 2; i++) {
            ctx.strokeStyle = `rgba(0, 0, 0, 0.2)`;
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(10, 15 + i * 20);
            ctx.lineTo(canvas.width - 10, 20 + i * 15);
            ctx.stroke();
        }
    }
    
    // Draw captcha on page load
    drawCaptcha();
    
    // Reload captcha button
    document.getElementById('reload-captcha').addEventListener('click', function() {
        window.location.reload();
    });
</script>

<style>
    /* Full Screen Background */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .login-container {
        min-height: 100vh;
        width: 100%;
        background: url('{{ asset('assets/img/kyb1.png') }}') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    /* Light Overlay */
    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* Adjusted overlay to be slightly darker to ensure white card pops but background is visible */
        background: rgba(0, 0, 0, 0.1); 
        z-index: 0;
    }

    /* Glassmorphism Card - White */
    .glass-card {
        width: 90%; /* Responsive width for mobile */
        max-width: 380px; /* Wider card, less tall */
        background: rgba(255, 255, 255, 0.85); /* Whitish Glass */
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
        z-index: 1;
        position: relative;
        padding: 18px 24px; /* Less vertical, more horizontal padding */
        margin: 10px;
    }
    
    /* Responsive: Tablet */
    @media (min-width: 768px) and (max-width: 1024px) {
        .glass-card {
            max-width: 340px;
            padding: 16px 20px;
        }
    }
    
    /* Responsive: Mobile */
    @media (max-width: 767px) {
        .glass-card {
            max-width: 320px;
            padding: 14px 18px;
        }
    }

    /* Input Fields - White/Clean */
    .glass-input {
        background: #fff !important; 
        border: 1px solid #e0e0e0;
        color: #333 !important;
        border-radius: 50px; /* Fully rounded (pill) */
        padding: 10px 12px 10px 38px; /* Compact padding */
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .glass-input:focus {
        background: #fff !important;
        border-color: #eb0a1e;
        box-shadow: 0 0 0 3px rgba(235, 10, 30, 0.1);
    }
    
    .glass-input::placeholder {
        color: #999;
        font-weight: 400;
        font-size: 0.9rem;
    }

    /* Primary Button */
    .glass-btn {
        background: #eb0a1e; 
        border: none;
        border-radius: 30px;
        padding: 10px; /* Compact padding */
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .glass-btn:hover {
        background: #c9081a;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(201, 8, 26, 0.3);
    }
    
    /* Button Warning Custom */
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #fff;
    }
</style>
@endsection
