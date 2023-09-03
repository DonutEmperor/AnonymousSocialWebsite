<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\BlockedIp;

class BlockedPageMiddleware
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

       // Check if the user's IP is blocked
       $blockedIp = BlockedIp::where('ip', $userIp)->first();
   
       if ($blockedIp) {
           // IP is blocked, allow access to the blocked page
           return $next($request);
       }
   
       // IP is not blocked, redirect to the homepage or another page
       return redirect()->route('not-found');
    }
}
