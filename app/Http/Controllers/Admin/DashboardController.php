<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;



class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function settingsUpdate(Request $request)
    {
        $filteredRequest = $request->except('_token');

        foreach ($filteredRequest as $key => $value) {
            BusinessSetting::updateOrCreate(
                ['type' => $key],
                ['value' => $value]
            );
        }

        Artisan::call('cache:clear');
        Toastr::success('Setting updated', 'Success');
        return redirect()->back();
    }
}
