<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            if (Auth::user()->is_role == $role) {
                return $next($request);
            } else {
                // Redirect user ke dashboard sesuai rolenya tanpa logout
                if (Auth::user()->is_role == 1) {
                    return redirect('admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                } elseif (Auth::user()->is_role == 2) {
                    return redirect('manager/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                }

                // Fallback untuk role yang tidak diketahui
                return redirect('/')->with('error', 'Role tidak dikenali.');
            }
        }

        return redirect(url('/'))->with('error', 'Silakan login terlebih dahulu.');
    }
}
