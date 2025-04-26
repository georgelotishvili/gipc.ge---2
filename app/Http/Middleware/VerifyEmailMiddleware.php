<?php

/**
 * This middleware is currently disabled. 
 * To enable email verification:
 * 1. Uncomment the MustVerifyEmail interface in the User model
 * 2. Uncomment Features::emailVerification() in config/fortify.php
 * 3. Uncomment the verifyEmailView in FortifyServiceProvider
 * 4. Register this middleware in app/Http/Kernel.php
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() &&
            $request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
} 