<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !session('otp_verified')) {
            return redirect()->route('otp.show');
        }

        return $next($request);
    }
}
