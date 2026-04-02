<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        if ($request->user() && $request->user()->isMember()) {
            return redirect()->route('membership.status')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return redirect('/')->with('error', 'Silakan login terlebih dahulu.');
    }
}
