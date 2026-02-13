<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // Generate random alphanumeric captcha code
        $captchaCode = $this->generateCaptchaCode();
        
        session(['captcha_code' => strtolower($captchaCode)]);
        
        return view('auth.login', ['captchaCode' => $captchaCode]);
    }
    
    private function generateCaptchaCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'integer'],
            'password' => ['required'],
            'captcha' => ['required', 'string'],
        ]);

        // Validate captcha (case insensitive)
        if (strtolower($request->captcha) != session('captcha_code')) {
            $captchaCode = $this->generateCaptchaCode();
            session(['captcha_code' => strtolower($captchaCode)]);
            
            return back()->withErrors([
                'captcha' => 'Kode CAPTCHA salah. Silakan coba lagi.',
            ])->onlyInput('username')->with('captchaCode', $captchaCode);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Clear captcha
            session()->forget('captcha_code');
            
            // Set OTP belum terverifikasi
            session(['otp_verified' => false]);

            // Ambil user dari database langsung
            $user = \App\Models\User::where('username', $request->username)->first();
            
            \Illuminate\Support\Facades\Log::info('LOGIN OTP DEBUG', [
                'user_found' => $user ? true : false,
                'user_id' => $user ? $user->id : null,
                'username' => $request->username,
            ]);

            // Hapus OTP lama & generate OTP baru (dummy: 123456)
            Otp::where('user_id', $user->id)->delete();
            $otp = Otp::create([
                'user_id' => $user->id,
                'code' => '123456',
                'expires_at' => now()->addMinutes(5),
            ]);
            
            \Illuminate\Support\Facades\Log::info('OTP CREATED', [
                'otp_id' => $otp->id,
                'otp_user_id' => $otp->user_id,
                'otp_code' => $otp->code,
            ]);
            
            // Redirect ke halaman OTP
            return redirect()->route('otp.show');
        }

        // Regenerate new captcha on failed login
        $captchaCode = $this->generateCaptchaCode();
        session(['captcha_code' => strtolower($captchaCode)]);

        return back()->withErrors([
            'username' => 'NPK atau password yang Anda masukkan salah.',
        ])->onlyInput('username')->with('captchaCode', $captchaCode);
    }

    public function logout(Request $request)
    {
        // Hapus OTP saat logout
        if (Auth::check()) {
            $userId = \App\Models\User::where('username', Auth::user()->username)->value('id');
            Otp::where('user_id', $userId)->delete();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
