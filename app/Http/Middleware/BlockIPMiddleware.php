<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\BlockedIp;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class BlockIPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the user's IP address
        $userIp = $request->ip();

        // Check if the user's IP is in the blockedip table
        $blockedIp = BlockedIp::where('ip', $userIp)->first();

        if ($blockedIp) {
            // IP is blocked, return a response or redirect as needed
            return redirect()->route('blocked'); // You can create a 'blocked' route for this purpose.
        }

        // IP is not blocked, allow access
        return $next($request);
    }
}
