<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSuperadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        switch (Auth::user()->getRoleNames()->first()) {
            case 'admin':
                $result = true;
                break;
            case 'superadmin':
                $result = true;
                break;

            default:
                $result = false;
                break;
        }

        if ($result == true) {
            return $next($request);
        } else {
            return abort('403', 'USER DOES NOT HAVE THE RIGHT ROLES.');
        }
    }
}
