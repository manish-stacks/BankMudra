<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =  Role::latest()->get();
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.roles.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array'
        ]);
    
        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'admin',
            ]);
          
            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions); 
            }
    
            Toastr::success('Role created successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Toastr::error('Failed to create Role. Please try again!', 'Failed');
            return redirect()->back();
        }
    }
    
  



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role =  Role::findorFail($id);
        return view('backend.roles.create', compact('role'));   

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array', 
        ]);
    
        try {
            $role->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
    
            if ($request->has('permissions')) {
                $role->syncPermissions($request->input('permissions', []));   
            }
    
            Toastr::success('Role updated successfully!', 'Success');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Toastr::error('Failed to update Role. Please try again!', 'Failed');
            return redirect()->back();
        }
    }
    

     /**
     * Remove the specified resource from storage.
     */
    public function destroyRole(Request $request)
    {
        $role = Role::find($request->id);

        if (!$role) {
            Toastr::error('Role not found', 'Failed');
            return redirect()->back();
        }
        $role->delete();
        Toastr::success('Role deleted successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Status enable and disable
     */
    public function status_enable_disable(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:roles,id',
            'status' => 'required|boolean',
        ]);

        $blog = Role::findOrFail($request->id);
        $blog->status  = $request->status;
        $blog->save();
        return response()->json(['message' => 'success']);
    }
}
