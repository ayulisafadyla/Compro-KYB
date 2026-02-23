@extends('layouts.guest')

@section('content')

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

    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        z-index: 0;
    }

    .glass-card {
        width: 90%;
        max-width: 380px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
        z-index: 1;
        position: relative;
        padding: 24px 28px;
        margin: 10px;
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .glass-card {
            max-width: 340px;
            padding: 20px 24px;
        }
    }

    @media (max-width: 767px) {
        .glass-card {
            max-width: 320px;
            padding: 18px 20px;
        }
    }

    /* OTP Input Boxes */
    .otp-box {
        width: 48px;
        height: 52px;
        text-align: center;
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        border: 1.5px solid #e0e0e0;
        border-radius: 12px;
        background: #fff;
        outline: none;
        transition: all 0.25s ease;
    }

    .otp-box:focus {
        border-color: #eb0a1e;
        box-shadow: 0 0 0 3px rgba(235, 10, 30, 0.1);
    }

    @media (max-width: 767px) {
        .otp-box {
            width: 42px;
            height: 46px;
            font-size: 1.1rem;
        }
    }

    /* Button */
    .glass-btn {
        background: #eb0a1e;
        border: none;
        border-radius: 30px;
        padding: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: white;
        transition: all 0.3s ease;
    }

    .glass-btn:hover {
        background: #c9081a;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(201, 8, 26, 0.3);
    }

    /* Timer Badge */
    .timer-badge {
        background: #eb0a1e;
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 20px;
    }
</style>

<div class="login-container">
    <div class="glass-card text-center">
        <div class="text-center">
            <img src="{{ asset ('assets/img/kyb-remove1.png') }}" alt="Logo" style="width: 80px;">
        </div>
        <h2 class="fw-bold mb-1" style="font-size: 1.2rem; color: #333;">Verifikasi OTP</h2>
        <p class="text-muted mb-3" style="font-size: 0.8rem;">Masukkan Kode OTP Yang Telah Dikirim</p>

        @if(session('success'))
            <div class="alert alert-success py-2 px-3 mb-3" style="font-size: 0.8rem; border-radius: 10px;">
                {{ session('success') }}
            </div>
        @endif

        @error('otp')
            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 0.8rem; border-radius: 10px;">
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="{{ route('otp.verify') }}" id="otpForm" autocomplete="off">
            @csrf

            <div class="otp-inputs d-flex justify-content-center gap-2 mb-3">
                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" pattern="[0-9]*" autofocus>
                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" pattern="[0-9]*">
                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" pattern="[0-9]*">
            </div>

            <!-- Hidden input untuk kirim OTP gabungan -->
            <input type="hidden" name="otp" id="otpHidden">

            <button type="submit" class="btn btn-primary w-100 glass-btn mb-3">
                Verifikasi
            </button>
        </form>

        <div class="timer-section">
            <span class="badge timer-badge" id="timer">5:00</span>
        </div>

        <div class="mt-2" id="resendSection" style="display: none;">
            <form method="POST" action="{{ route('otp.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none" style="font-size: 0.8rem; color: #eb0a1e;">
                    Kirim Ulang OTP
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // OTP Input Box Logic
    const otpBoxes = document.querySelectorAll('.otp-box');
    const otpHidden = document.getElementById('otpHidden');
    const otpForm = document.getElementById('otpForm');

    otpBoxes.forEach((box, index) => {
        box.addEventListener('input', (e) => {
            const value = e.target.value;
            // Hanya angka
            e.target.value = value.replace(/[^0-9]/g, '');

            if (e.target.value && index < otpBoxes.length - 1) {
                otpBoxes[index + 1].focus();
            }
        });

        box.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpBoxes[index - 1].focus();
            }
        });

        // Handle paste
        box.addEventListener('paste', (e) => {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
            pastedData.split('').forEach((char, i) => {
                if (otpBoxes[i]) {
                    otpBoxes[i].value = char;
                }
            });
            if (pastedData.length > 0) {
                const focusIndex = Math.min(pastedData.length, otpBoxes.length) - 1;
                otpBoxes[focusIndex].focus();
            }
        });
    });

    // Gabungkan OTP saat submit
    otpForm.addEventListener('submit', (e) => {
        let otp = '';
        otpBoxes.forEach(box => otp += box.value);
        otpHidden.value = otp;

        if (otp.length !== 6) {
            e.preventDefault();
            alert('Masukkan 6 digit kode OTP');
        }
    });

    // Timer Countdown
    const timerEl = document.getElementById('timer');
    const resendSection = document.getElementById('resendSection');

    @if($expiresAt)
        let remaining = Math.max(0, {{ $expiresAt }} - Math.floor(Date.now() / 1000));
    @else
        let remaining = 300; // 5 minutes default
    @endif

    function updateTimer() {
        if (remaining <= 0) {
            timerEl.textContent = '0:00';
            timerEl.style.background = '#dc3545';
            resendSection.style.display = 'block';
            return;
        }

        const minutes = Math.floor(remaining / 60);
        const seconds = remaining % 60;
        timerEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        remaining--;
        setTimeout(updateTimer, 1000);
    }

    updateTimer();
</script>

@endsection
