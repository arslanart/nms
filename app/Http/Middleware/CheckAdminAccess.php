<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // ตรวจสอบ user_type
        if (Auth::check() && Auth::user()->user_type !== 'Admin') {
            // หาก user_type ไม่ใช่ Admin ให้ redirect ไปหน้าอื่น
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
