<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isSubscriptionActive()) {
            return redirect()->route('pricing')->with('message', 'ამ გვერდების ნახვისთვის გთხოვთ შეიძინოთ პრემიუმ პაკეტი');
        }
        return $next($request);
    }
}
