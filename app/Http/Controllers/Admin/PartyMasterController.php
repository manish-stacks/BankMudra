<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartyMaster;
use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartyMasterController extends Controller
{
    use ImageStore;
    public function index()
    {
        $users = PartyMaster::all();
        return view('backend.party_master.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.party_master.create_form');
    }

    public function store(Request $request)
    {


        $request->validate([
            'party_name' => 'required|string|max:255',
        ]);


        $aadhaarPath = null;
        if ($request->hasFile('aadhaar')) {
            $aadhaarPath = $this->saveImage($request->file('aadhaar'));
        }

        $panPath = null;
        if ($request->hasFile('pan')) {
            $panPath = $this->saveImage($request->file('pan'));
        }

        $profilePath = null;
        if ($request->hasFile('profile')) {
            $profilePath = $this->saveImage($request->file('profile'));
        }


        $data = $request->all();
        $data['aadhaar'] = $aadhaarPath;
        $data['pan'] = $panPath;
        $data['profile'] = $profilePath;
        $data['status'] = 'active';
        $data['created_by'] = auth()->id();
        $data['password'] = Hash::make($request->mobile_no);

        PartyMaster::create($data);
        Toastr::success('Party Master saved successfully', 'Success');
        return redirect()->back()->with('success', 'Party Master saved successfully!');
    }

    public function edit($id)
    {
        $editMember = PartyMaster::findOrFail($id);
        return view('backend.party_master.edit_form', compact('editMember'));
    }
}
