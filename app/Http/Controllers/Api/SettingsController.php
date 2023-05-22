<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::where('status', 1)->get();
        if (Setting::where('status', 1)->exists()) {
            return response()->json(['settings' => $settings], 200);
        } else {
            return response()->json(['settings' => 'settings'], 404);
        }
    }

    public function show($name)
    {
        if (Setting::where('name', $name)->where('status', 1)->exists()) {
            $setting = Setting::where('name', $name)->where('status', 1)->first();
            return response()->json(['setting' => $setting], 200);
        } else {
            return response()->json(['setting' => 'setting-not-found'], 404);
        }
    }
}
