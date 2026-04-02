<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all();
        return view('admin.site-settings.index', compact('settings'));
    }

    public function update(Request $request, SiteSetting $site_setting)
    {
        $request->validate([
            'value' => 'required_without:image_value',
            'image_value' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ]);

        if ($site_setting->type == 'image' && $request->hasFile('image_value')) {
            // Delete old image
            if ($site_setting->value && Storage::disk('public')->exists($site_setting->value)) {
                Storage::disk('public')->delete($site_setting->value);
            }
            
            // Store new image
            $path = $request->file('image_value')->store('settings', 'public');
            $site_setting->update(['value' => $path]);
        } else {
            $site_setting->update([
                'value' => $request->value,
            ]);
        }

        return redirect()->back()->with('success', 'Setting berhasil diperbarui!');
    }
}
