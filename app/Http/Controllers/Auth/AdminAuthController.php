<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }
 

  

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return back()->withErrors(['email' => 'These credentials do not match our records.']);
    //     }

    //     if ($user->status == 0) {
    //         return back()->withErrors(['email' => 'Your account is not active. Please contact support.']);
    //     }

    //     // Check role status
    //     $role = $user->roles()->first(); // Assuming user has one role
    //     if ($role && $role->status == 0) {
    //         return back()->withErrors(['email' => 'Your role is inactive. Please contact the administrator.']);
    //     }

    //     if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
    //         return redirect()->intended(route('admin.dashboard'));
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials.']);
    // }




    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->status == 0 || $user->roles->where('status', 0)->isNotEmpty()) {
            return back()->withErrors(['email' => $user && $user->status == 0 ? 
                'Your account is not active. Please contact support.' : 
                ($user && $user->roles->where('status', 0)->isNotEmpty() ? 
                    'Your role is inactive. Please contact the administrator.' : 
                    'These credentials do not match our records.'
                )]);
        }

        return Auth::guard('admin')->attempt($request->only('email', 'password')) 
            ? redirect()->intended(route('admin.dashboard')) 
            : back()->withErrors(['email' => 'Invalid credentials.']);
    }



    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
