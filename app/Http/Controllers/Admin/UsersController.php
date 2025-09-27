<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Role;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\ImageStore;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    use ImageStore;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('profileImage:id,external_link')->latest()->get();
        
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('status',1)->latest()->get();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
            $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|exists:roles,id',
            'profile' => 'nullable|image',
        ]);
        
        try {
            $profileImagePath = null;
        
            if ($request->hasFile('profile')) {
                $profileImagePath = $this->saveImage($request->file('profile'));
            }
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'profile' => $profileImagePath,
                 'created_by' => auth()->id(),
            ]);
        
            $role = Role::findOrFail($request->role);
            $user->syncRoles([$role]);
        
            Toastr::success('User created successfully!', 'Success');
            return redirect()->back();
        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Toastr::error('Failed to create user. Please try again!', 'Failed');
            return redirect()->back();
        }

    }    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $profileImage = null;
        if ($user->profile) {
            $profileImage = Upload::where('id', $user->profile)->value('external_link');
        }

        $roles = Role::where('status', 1)->latest()->get();
        return view('backend.users.create', compact('roles', 'user', 'profileImage'));
    }


    /**
     * Update the specified resource in storage.
     */

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'password' => 'nullable|confirmed|min:6',
    //         'role' => 'required|integer',
    //         'profile' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
    //     ]);

    //     try {
    //         $user = User::findOrFail($id);
    //         $profileImagePath = $user->profile;

    //         if ($request->hasFile('profile')) {
    //             if ($user->profile && is_numeric($user->profile)) {
    //                 $this->deleteImage($user->profile);
    //             }
    //             $profileImagePath = $this->saveImage($request->file('profile'));
    //         }

    //         $user->update([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'profile' => $profileImagePath,
    //             'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
    //         ]);

    //         // Sync role using Spatie
    //         $role = Role::findOrFail($request->role);
    //         $user->syncRoles([$role]);
            

    //         Toastr::success('User updated successfully!', 'Success');
    //         return redirect()->back();

    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         Toastr::error('Failed to update user. Please try again!', 'Failed');
    //         return redirect()->back();
    //     }
    // }
    
    
    public function update(Request $request, string $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|confirmed|min:6',
        'role' => 'required|exists:roles,id',
        'profile' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
    ]);

    try {
        $user = User::findOrFail($id);
        $profileImagePath = $user->profile;

        if ($request->hasFile('profile')) {
            // Delete old image if exists
            if ($user->profile && file_exists(public_path($user->profile))) {
                $this->deleteImage($user->profile);
            }

            // Save new image
            $profileImagePath = $this->saveImage($request->file('profile'));
        }

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile' => $profileImagePath,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        // Update user role
        $role = Role::findOrFail($request->role);
        $user->syncRoles([$role]);

        Toastr::success('User updated successfully!', 'Success');
        return redirect()->back();

    } catch (\Exception $e) {
        Log::error($e->getMessage());
        Toastr::error('Failed to update user. Please try again!', 'Failed');
        return redirect()->back();
    }
}


   /**
     * Remove the specified resource from storage.
     */
    public function destroyUser(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            Toastr::error('user not found', 'Failed');
            return redirect()->back();
        }
        $this->deleteImage($user->profile);
        $user->delete();
        Toastr::success('user deleted successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Status enable and disable
     */
    public function status_enable_disable(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'status' => 'required|boolean',
        ]);

        $user = User::findOrFail($request->id);
        $user->status  = $request->status;
        $user->save();
        return response()->json(['message' => 'success']);
    }
}
