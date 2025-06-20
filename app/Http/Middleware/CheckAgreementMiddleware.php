<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAgreementMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user has accepted the agreement
        if (!session()->has('agreement_accepted')) {
            // Store the intended URL to redirect back after agreement
            session()->put('intended_url', $request->url());
            
            // Extract plan ID from URL if present
            $path = $request->path();
            if (preg_match('/subscribe\/(\d+)/', $path, $matches)) {
                session()->put('redirected_plan_id', $matches[1]);
            }
            
            // Redirect to pricing page with agreement modal
            return redirect()->route('pricing')->with('show_agreement', true);
        }

        return $next($request);
    }
} 