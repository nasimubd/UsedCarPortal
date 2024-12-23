<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role !== 'user') {
            return redirect()->back()->with('error', 'Only users can place bids');
        }

        return $next($request);
    }
}
