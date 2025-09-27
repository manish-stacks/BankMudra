<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Modules\GeneralSettings\App\Models\WebsiteSettings;

class WebsiteSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view-general-settings')->only(['index']);
        $this->middleware('permission:update-general-settings')->only(['update']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_copyrights' => 'nullable|string|max:255',
            'site_email' => 'nullable|email|max:255',
            'site_description' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:255',
            'support_email' => 'nullable|email|max:255',
            'allow_registration' => 'nullable|in:enable,disable,on_request',
            'contact_address' => 'nullable|string',
        ]);
        WebsiteSettings::updateOrCreate(
            ['id' => 1], 
            [
                'site_name' => $validated['site_name'],
                'site_copyrights' => $validated['site_copyrights'],
                'site_email' => $validated['site_email'],
                'site_description' => $validated['site_description'],
                'contact_phone' => $validated['contact_phone'],
                'support_email' => $validated['support_email'],
                'allow_registration' => $validated['allow_registration'],
                'contact_address' => $validated['contact_address'],
            ]
        );

        Toastr::success('Website settings updated successfully', 'Success');
        return redirect()->back();
    }

}
