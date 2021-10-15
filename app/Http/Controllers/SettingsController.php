<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

class SettingsController extends Controller
{

    function insertNewPassword(Request $request)
    {
        $setting = new Setting();
        $setting->password = $request->password;
        $setting->save();

        return $this->settings();
    }

    function getSettings()
    {
        return Setting::orderBy('id', 'desc')->first();
    }

    function settings()
    {

        $settings = $this->getSettings();
        // dd($settings);
        return view('settings')->with(['settings' => $settings]);
    }

    function getPassword()
    {

        return response()->json(['success' => 1, 'password' => $this->getSettings()->password]);
    }
}
