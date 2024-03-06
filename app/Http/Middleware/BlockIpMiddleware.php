<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockIpMiddleware
{
    // set IP addresses
    public $blockIps = ['127.0.0.1','187.251.242.253','192.168.3.47'];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (in_array($request->ip(), $this->blockIps)) {
            return response()->json([
                'message' => "You don't have permission to access this website.",
                'ip_address' => $request->ips()
            ], 401);
        }
        return $next($request);
    }
}
