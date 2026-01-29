<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgeCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Check if user has verified their age (18+) in the session.
     * If not verified or under 18, redirect to access denied page.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if age verification exists in session
        if (!session()->has('verified_age')) {
            // No age verification, redirect to age check form
            return redirect()->route('age-check')
                ->with('warning', 'Please verify your age to access this content.');
        }

        $verifiedAge = session('verified_age');

        // If age is less than 18, show access denied
        if ($verifiedAge < 18) {
            $yearsRemaining = 18 - $verifiedAge;
            return redirect()->route('age-denied', ['years' => $yearsRemaining]);
        }

        return $next($request);
    }
}
