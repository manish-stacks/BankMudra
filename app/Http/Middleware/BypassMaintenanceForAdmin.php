<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BypassMaintenanceForAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the app is in maintenance mode
        if (File::exists(storage_path('framework/down'))) {
            // If it's a non-admin route, show the maintenance page
            if (! $request->is('admin*')) {
                return response()->view('errors::maintenance', [], 503);
            }
        }
        return $next($request);

    }
}
