<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->age >= 18) {
            return $next($request);
        }

        return redirect('home')->with('error', 'You must be at least 18 years old to access this page.');
    }
}