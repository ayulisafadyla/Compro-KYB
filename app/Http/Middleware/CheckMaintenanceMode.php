<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SiteSetting;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bypass for admin routes and login/logout
        if ($request->is('admin*') || $request->is('login') || $request->is('logout')) {
            return $next($request);
        }

        // Check if maintenance mode is enabled
        // Use cache to prevent DB query on every request if possible, but for now direct query is fine for low traffic
        try {
            $maintenance = SiteSetting::where('key', 'maintenance_mode')->value('value');
            
            if ($maintenance == '1') {
                return response()->view('errors.maintenance', [], 503);
            }
        } catch (\Exception $e) {
            // If DB not ready or other error, proceed
        }

        return $next($request);
    }
}
