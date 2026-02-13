<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    /**
     * Ambil primary key (id) user yang login.
     * Tidak bisa pakai Auth::user()->id karena getAuthIdentifierName() override ke username.
     */
    private function getUserPrimaryKey()
    {
        return User::where('username', Auth::user()->username)->value('id');
    }

    public function showOtpForm()
    {
        // Jika sudah verifikasi OTP, langsung ke dashboard
        if (session('otp_verified')) {
            return redirect()->route('admin.dashboard');
        }

        $userId = $this->getUserPrimaryKey();

        // Ambil OTP untuk user yang login
        $otp = Otp::where('user_id', $userId)
            ->latest()
            ->first();

        // Jika belum ada OTP (misal dari session lama), generate otomatis
        if (!$otp) {
            $otp = Otp::create([
                'user_id' => $userId,
                'code' => '123456',
                'expires_at' => now()->addMinutes(5),
            ]);
        }

        $expiresAt = $otp->expires_at->timestamp;

        return view('auth.otp', compact('expiresAt'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $userId = $this->getUserPrimaryKey();

        $otp = Otp::where('user_id', $userId)
            ->latest()
            ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak ditemukan. Silakan kirim ulang.']);
        }

        if ($otp->isExpired()) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.']);
        }

        if ($otp->code !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah. Silakan coba lagi.']);
        }

        // OTP valid — tandai session dan hapus OTP dari database
        session(['otp_verified' => true]);
        $otp->delete();

        return redirect()->route('admin.dashboard');
    }

    public function resendOtp()
    {
        $userId = $this->getUserPrimaryKey();

        // Hapus OTP lama
        Otp::where('user_id', $userId)->delete();

        // Generate OTP baru (dummy: 123456)
        Otp::create([
            'user_id' => $userId,
            'code' => '123456',
            'expires_at' => now()->addMinutes(5),
        ]);

        return back()->with('success', 'Kode OTP baru telah dikirim.');
    }
}
