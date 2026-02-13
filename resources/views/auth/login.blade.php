@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="glass-card">
        <div class="text-center mb-3">
            <img src="{{ asset ('images/kyb-remove2.png') }}" alt="Logo" style="width: 180px;" class="mb-2">
            <h2 class="text-danger fw-bold fs-5">Sign In</h2>
        </div>

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
            <div class="mb-2 d-flex align-items-center">
                <div class="p-2 d-flex align-items-center justify-content-center me-2 bg-white rounded">
                    <canvas id="captcha-canvas" width="150" height="45"></canvas>
                </div>
                <button type="button" class="btn btn-danger rounded-circle shadow-sm" id="reload-captcha" style="width: 40px; height: 40px;">
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
     .body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: 'Segoe UI', sans-serif;
    }

    /* ===== BACKGROUND CONTAINER ===== */
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

    /* Light overlay supaya teks tetap terbaca tapi background jelas */
    .login-container::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.15);
        z-index: 0;
    }

    /* ===== CARD ===== */
    .glass-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        border-radius: 32px;
        padding: 40px 32px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* ===== TITLE ===== */
    .glass-card h2 {
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 25px;
    }

    /* ===== INPUT FIELD ===== */
    .glass-input {
        background: #f7f8fa !important;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 12px 14px 12px 45px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.25s ease;
    }

    .glass-input:focus {
        background: #ffffff !important;
        border-color: #eb0a1e;
        box-shadow: 0 0 0 4px rgba(235, 10, 30, 0.1);
    }

    .glass-input::placeholder {
        color: #9ca3af;
        font-weight: 400;
    }

    /* ===== ICON POSITION ===== */
    .position-relative i {
        font-size: 16px;
        color: #9ca3af !important;
    }

    /* ===== CAPTCHA BOX ===== */
    canvas {
        border-radius: 12px;
    }

    /* ===== RELOAD BUTTON ===== */
    #reload-captcha {
        border-radius: 12px !important;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== LOGIN BUTTON ===== */
    .glass-btn {
        background: linear-gradient(135deg, #eb0a1e, #d60018);
        border: none;
        border-radius: 16px;
        padding: 14px;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .glass-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(235, 10, 30, 0.35);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .glass-card {
            padding: 30px 22px;
            border-radius: 24px;
        }
    }
</style>
</style>
@endsection
