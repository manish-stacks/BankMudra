<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class IsAdmin
{
    /**
     * Handle an incoming request.
     */

    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
    
            // Get all active roles from the roles table
            $activeRoleIds = Role::where('status', 1)->pluck('id')->toArray();
            $userRoleIds = $user->roles->pluck('id')->toArray();

    
            if (!empty(array_intersect($activeRoleIds, $userRoleIds))) {
                return $next($request);
            }
    
            \Log::warning('Admin attempted login with no valid role.', [
                'user_id' => $user->id,
                'user_role_ids' => $userRoleIds,
                'active_role_ids' => $activeRoleIds,
            ]);
    
            Auth::guard('admin')->logout();
        }
    
        return redirect()->route('admin.login')->withErrors([
            'access' => 'You do not have permission to access this area.',
        ]);
    }
    
}
