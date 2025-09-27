<?php

use App\Models\BusinessSetting;
use App\Models\Upload;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

const SUPAR_ADMIN = 1;
const ADMIN = 2;
const STUDENT = 3;


if (!function_exists('static_asset')) {
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}



if (!function_exists('get_setting')) {
    function get_setting($key, $default = null, $lang = false)
    {
        $settings = Cache::remember('business_settings', 86400, function () {
            return BusinessSetting::all();
        });

        if ($lang == false) {
            $setting = $settings->where('type', $key)->first();
        } else {
            $setting = $settings->where('type', $key)->where('lang', $lang)->first();
            $setting = !$setting ? $settings->where('type', $key)->first() : $setting;
        }
        return $setting == null ? $default : $setting->value;
    }
}


if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        $file = Upload::find($id);

        if ($file && File::exists($file->external_link)) {
            return app('url')->asset($file->external_link);
        }

        return static_asset('demo/img/placeholder.svg');
    }
}

if (!function_exists('inicompute')) {
    function inicompute($array)
    {
        if (is_object($array)) {
            if (count(get_object_vars($array))) {
                return count(get_object_vars($array));
            }
            return 0;
        } elseif (is_array($array)) {
            if (count($array)) {
                return count($array);
            }
            return 0;
        } elseif (is_string($array)) {
            return 1;
        } elseif (is_null($array)) {
            return 0;
        } elseif (is_int($array)) {
            return (int) $array;
        } elseif (is_float($array)) {
            return (float) $array;
        } else {
            return count($array);
        }
    }
}



if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $settings = Cache::remember('business_settings', 86400, function () {
            return BusinessSetting::all();
        });
        $setting = $settings->where('type', $key)->first();
        return $setting == null ? $default : $setting->value;
    }
}


