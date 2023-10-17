<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Comment;
use App\Models\BlockedIp;
use Symfony\Component\HttpFoundation\Response;

class CheckDownvoteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check downvotes for threads
        $threads = Thread::where('downvotes', '>', 50)->get();
        foreach ($threads as $thread) {
            // Check if the IP is already blocked
            $existingIp = BlockedIp::where('ip', $thread->creator_ip)->first();

            // If IP doesn't exist in blocked_ips table, block it
            if (!$existingIp) {
                BlockedIp::create(['ip' => $thread->creator_ip]);
            }
            // thread is deleted
            $thread->delete();
        }

        // Check downvotes for comments
        $comments = Comment::where('downvotes', '>', 50)->get();
        foreach ($comments as $comment) {
            // Check if the IP is already blocked
            $existingIp = BlockedIp::where('ip', $comment->creator_ip)->first();

            // If IP doesn't exist in blocked_ips table, block it
            if (!$existingIp) {
                BlockedIp::create(['ip' => $comment->creator_ip]);
            }
            // comment is deleted
            $comment->delete();
        }

        return $next($request);
    }
}
