<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TeacherAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Cek apakah user login sebagai teacher
        if (!Auth::guard('teacher')->check()) {
            return redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']);
        }

        $user = Auth::guard('teacher')->user();

        // Hanya teacher dengan level admin yang boleh akses
        if ($user->level !== 'admin') {
            return redirect()->route('teacher.login')->withErrors(['message' => 'Access denied.']);
        }

        return $next($request);
    }
}
