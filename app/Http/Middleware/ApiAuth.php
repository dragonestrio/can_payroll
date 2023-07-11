<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuth
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
        $api = new Api;

        if (Auth::check() == true) {
            return $next($request);
        } else {
            return $api->responseError('login terlebih dahulu!');
        }
    }
}
