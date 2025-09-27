<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Traits\ImageStore;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


class GeneralSettingsController extends Controller
{


    use ImageStore;

    public function index()
    {
        return view('generalsettings::index');
    }


    public function settingStore(Request $request)
    {
        try {
            $data = $request->except('_token');

            foreach ($data as $key => $val) {
                // Handle image uploads
                if ($request->hasFile($key)) {
                    $val = $this->saveImage($request->file($key)); // save and get path
                }

                // Save to BusinessSetting
                $setting = BusinessSetting::where('key', $key)->first();

                if (!$setting) {
                    $setting = new BusinessSetting();
                    $setting->key = $key;
                }

                $setting->value = $val;
                $setting->save();
            }

            Artisan::call('optimize:clear');
            Toastr::success('Settings updated successfully', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    /* public function settingStore(Request $request)
     {
         try {
             foreach ($request->except('_token') as $key => $val) {
                 $setting = BusinessSetting::where('key', $key)->first();

                 if (empty($setting)) {
                     $ss = new BusinessSetting();
                     $ss->key = $key;
                     $ss->value = $val;
                     $ss->save();
                 } else {
                     $setting->value = $val;
                     $setting->save();
                 }
             }
             Artisan::call('optimize:clear');
             Toastr::success('Updated', 'Success');
             return redirect()->back();
         } catch (\Exception $th) {
             dd($th->getMessage());
         }
     } */

    public function sliders()
    {
        return view('generalsettings::sliders.index');
    }

    public function paymentIndex()
    {
        return view('generalsettings::payment.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('generalsettings::profile.index', compact('user'));
    }
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);
        $user = Auth::user();
        
        if ($request->hasFile('profile')) {
            $profile = $this->saveImage($request->file('profile'));
            $user->profile = $profile;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        Toastr::success('Profile updated successfully', 'Success');
        return redirect()->back();
    }
}
