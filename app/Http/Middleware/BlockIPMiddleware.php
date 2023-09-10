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
        // // Get the user's IP address
        // $userIp = $request->ip();
        
        // // Check if the user's IP is in the blockedip table
        // $encryptedBlockedIps = BlockedIp::select('ip')->get();
        // foreach ($encryptedBlockedIps as $blockedIp) {
        //     if($blockedIp->ip!=null && $blockedIp->ip!=""){
        //         $decryptedBlockedIp = decrypt($blockedIp->ip);
        //         // Compare the decrypted IP with the user's IP
        //         if ($decryptedBlockedIp === $userIp) {
        //             // The user's IP is blocked
        //             // IP is blocked, return a response or redirect as needed
        //             return redirect()->route('blocked');

        //             // Exit the loop since the user is blocked
        //         }
        //     }
        // }
        // // IP is not blocked, allow access
        // return $next($request);
        // Get the user's IP address
        // Get the user's IP address
        $userIp = $request->ip();

        // Decrypt the IP addresses from your database and check if the user's IP is in the blockedip table
        $encryptedBlockedIps = BlockedIp::select('ip')->get();
        foreach ($encryptedBlockedIps as $blockedIp) {
            $decryptedBlockedIp = decrypt($blockedIp->ip);
            
            // Compare the decrypted IP with the user's IP
            if ($decryptedBlockedIp === $userIp) {
                // The user's IP is blocked
                // IP is blocked, return a response or redirect as needed
                return redirect()->route('blocked');
            }
        }

        // IP is not blocked, allow access
        return $next($request);
       
    }
}
